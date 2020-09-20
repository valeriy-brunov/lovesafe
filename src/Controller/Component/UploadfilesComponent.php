<?php
declare(strict_types=1);

namespace Lovesafe\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Network\Exception\NotFoundException;
use Lovesafe\Plugin as LovesafePlugin;
use Laminas\Diactoros\Stream;

/**
 * Uploadfiles component
 *
 * Для начала работы компонента его необходимо загрузить в методе инициализации контроллёра:
 * -------------------------------------------------------------------
 * 	public function initialize(): void
 *		{
 *			parent::initialize();
 *			$this->loadComponent('Lovesafe.Uploadfiles', [настройки]);
 *		}
 * -------------------------------------------------------------------
 *
 * Далее в метод контроллёра вставить:
 * -------------------------------
 *	$this->Uploadfiles->upload();
 * -------------------------------
 *
 * Перечень обязательных настроек:
 *		'request' - объект контроллёра Cake\Http\ServerRequest;
 *		'user_id' - id пользователя, которое будет внесено в ТБ 'Files'.
 *
 * Перечень необязательных настроек.
 *		'album_id' - id альбома из ТБ 'albums'. Такой ТБ может и не быть.
 *		'image_quality' - качество фотографии после её масштабирования. По умолчанию 100%.
 *		'status' - статус файла после его загрузки. По умолчанию 1 - постоянный.
 *		'name_files_config' - имя дополнительного конфигурационного файла, который перекроет настройки файла конфигурации по умолчанию.
 *
 * Дополнительные публичные методы:
 *		$fids_arr = $this->Uploadfiles->fid(); // Возвращает массив fid загруженных файлов за одну сессию.
 *		$size_arr_files = $this->Uploadfiles->totalSize(); // Возвращает размер в байтах всех загруженных файлов за одну сессию. Если
 *														   // загружалось изображение, то для каждого преобразования размер указывается
 *														   // отдельно.
 */
class UploadfilesComponent extends Component
{
  /**
   * Default configuration.
   *
   * @var array
   */
  protected $_defaultConfig = [];

  /**
	 * Исходные размеры изображения.
	 *
	 * @var int
	 */
  	protected $_height;
	protected $_width;

	/**
	 * Новые значения высоты и ширины изображения.
	 *
	 * @var int
	 */
	protected $_new_height;
	protected $_new_width;

	/**
	 * Способ (назание метода) изменения изображения.
	 */
	protected $_nameZoom;

	/**
	 * Качество изображения.
	 */
	protected $_image_quality = 100;

	/**
	 * Глобальная переменная $_FILE.
	 */
	protected $_file;

	/**
	 * Метаданные загруженного временного файла.
	 *
	 * @var array
	 */
	protected $_metaDataFile;

	/**
	 * Адрес до файла без разделителей и расширения, для записи в таблицу.
	 */
	protected $_url;

	/**
	 * Адрес до файла без названия и расширения файла на конце. Для создания директории.
	 */
	protected $_url_not_ext;

	/**
	 * Полный адрес до файла с расширением.
	 */
	protected $_full_url;
	
	/**
	 * Содержит оригинальный загруженный файл из временной директории.
	 */
	protected $_upload_file;

	/**
	 * Содержит изменённый файл.
	 */
	protected $_new_upload_file;

	/**
	 * Коэффициент пропорциональности, который будет указан в таблице Files. Рассчитывается, как отношение ширины
	 * к высоте фотографии.
	 */
	protected $_k = NULL;

	/**
	 * id пользователя, который будет указан в таблице Files (кому принадлежит файл).
	 */
	protected $_id_user;

	/**
	 * Место, где располагаются на сервере файлы.
	 */
	protected $_scrUrl;

	/**
	 * Поддериктория куда будет загружаться файл. Поддериктория идёт следом
	 * за $_scrUrl.
	 */
	protected $_subDir;

	/**
	 * Статус файла, который указывается при записи в ТБ.
	 */
	protected $_status = 1;

	/**
	 * Общий размер файла в байтах, который загружен на сервер. Для изображений обычно применяется
	 * несколько преобразований с разнымы размерами получаемой картики. Поэтому для изображения размер
	 * будет складываться из размера всех преобразований картинки для одного изображения.
	 */
	protected $_totalSize = NULL;

	/**
	 * Содержит массив fid загруженных файлов.
	 *
	 * @var array
	 */
	protected $_fid = [];
	
	/**
	 * Содержит массив размеров загруженных файлов. Если загружалось изображение, то для каждого преобразования
	 * размер указывается отдельно.
	 *
	 * @var array
	 */
	protected $_totalSizeFiles = [];
	
	/**
	 * Содержит массив адресов до загруженных файлов в одной сессии.
	 * 
	 * @var array
	 */
	protected $_urls = [];

	/**
	 * Выполняем необходимые настройки компонента.
	 */
	public function initialize( array $config ): void
  	{
		// Cake\Http\ServerRequest
		//$this->_request = $config['request'];
		$this->_request = $this->getController()->getRequest();
		$this->_urls = [];

		// Загружаем файл конфигурации 'files_default'.
		// use Lovesafe\Plugin as LovesafePlugin;
		$plugin = new LovesafePlugin();
		Configure::config( 'default', new PhpConfig( $plugin->getPath() . 'config/' ) );
		Configure::load( 'upload_files_default' );

		// Если необходимо, подгружаем дополнительный файл конфигурации.
		if ( isset( $config['name_files_config'] ) ) {
			Configure::load( $config['name_files_config'] );
		}

		$this->_scrUrl = Configure::read( 'load.scrUrl' );

		if ( isset( $config['album_id'] ) ) {
			$this->_album = $config['album_id'];
		}
		if ( isset( $config['user_id'] ) ) {
			$this->_id_user = $config['user_id'];
		}
		if ( isset( $config['image_quality'] ) ) {
			$this->_image_quality = $config['image_quality'];
		}
		if ( isset( $config['status'] ) ) {
			$this->_status = $config['status'];
		}
  	}

	/**
	 * Метод загрузки файлов c любым расширением изображения.
	 */
	public function upload()
	{
		// Файл может быть загружен только методом Post.
		if ( $this->_request->is( 'post' ) ) {
			// Принимаем данные.
			$files = $this->_request->getData( 'myfile' );
			// Так как у нас форма multiple, загружаем каждый файл по отдельности.
			foreach ( $files as $file ) {
				$this->_file = $file;
				$this->_metaDataFile = $file->getStream()->getMetadata();
				$this->_url = md5( rand( 10000, 99999 ) . time() . rand( 10000, 99999 ) );
				$this->_requestFile();
				if ( $this->_status == 2 ) {
					$this->_status = 1;
				}
			}
		}
	}

	/**
	 * Определяет тип файла (изображение, видео) и, взависимости от типа файла, выполняет ряд действий.
	 */
	protected function _requestFile()
	{
		// Получаем расширение загруженного файла.
		$ext = $this->_ext();
		// Загружаем из файла конфигурации массив расширений файлов соответствующих изображениям.
		$scrExt = Configure::read( 'load.scrExt' );
		if ( in_array( $ext, $scrExt ) ) {
			// Расширение загруженного файла соответствует изображению.
			// Определяем размеры оригинала изображения.
			list( $this->_width, $this->_height ) = getimagesize( $this->_metaDataFile['uri'] );
			// Подсчитываем коэффициент пропорциональности.
			$this->_k = round( ( $this->_width / $this->_height ), 4 );
			// Загружаем изображение из временной директории.
			switch ( $ext ) {
			 	case 'jpeg':
					$this->_upload_file = imagecreatefromjpeg( $this->_metaDataFile['uri'] );
			 		break;
			 	case 'png':
			 		$this->_upload_file = imagecreatefrompng( $this->_metaDataFile['uri'] );
			 		break;
			 	case 'bmp':
			 		$this->_upload_file = imagecreatefromwbmp( $this->_metaDataFile['uri'] );
			 		break;
			 	case 'gif':
			 		$this->_upload_file = imagecreatefromgif( $this->_metaDataFile['uri'] );
			}
			// Извлекает и настраивает основные конфигурации для изображения, а также записывает файл на сервер.
			$this->_configScr();
			// Сохраняем запись о файле в БД.
			$this->_saveFileBD();
		}
	}

	/**
	 * Возвращает расширение файла по его mime.
	 */
	protected function _ext()
	{
		$array_conf = Configure::read( 'ext' );
		foreach ( array_keys( $array_conf ) as $key=>$ext ) {
			$arr = Configure::read( 'ext.' . $ext );
			foreach ( $arr as $val ) {
				if ( $this->_file->getClientMediaType() == $val ) {
					return $ext;
				}
			}
		}
	}

	/**
	 * Извлекает основные конфигурации для изображения, согласно загруженной конфигурации, изменяет размеры изображения.
	 */
	protected function _configScr()
	{
		$arr = Configure::read( 'scr' );
		foreach ( $arr as $key=>$val ) {
			$this->_subDir = $key;
			$this->_new_height = Configure::read( 'scr.' . $this->_subDir . '.height' );
			$this->_new_width = Configure::read( 'scr.' . $this->_subDir . '.width' );
			$this->_nameZoom = Configure::read( 'scr.' . $this->_subDir . '.zoom' );
			$url = [substr( $this->_url, 0, 2 ), substr( $this->_url, 2, 2 ), substr( $this->_url, 4 )];
			$this->_url_not_ext = $this->_scrUrl . $this->_subDir . DS . $url[0] . DS . $url[1];
			$this->_full_url = $this->_url_not_ext . DS . $url[2] . '.' . $this->_ext();
			$this->_urls[] = $url[0] . '-' . $url[1] . '-' . $url[2] . '.' . $this->_ext();
			// Масштабируем изображение.
			$nameZoom = '_zoomScr' . $this->_nameZoom;
			$this->$nameZoom();
			// Сохраняем изображение на сервере.
			$this->_saveScrFile();
		}
	}

	/**
	 * Создаёт директорию и записывает изображение в созданную директорию.
	 */
	protected function _saveScrFile()
	{
		// Создаём вложенные папки.
		$folder = new Folder();
		if ( $folder->create( $this->_url_not_ext ) ) {
		  	// Записываем новый файл в директорию.
			if ( imagejpeg( $this->_new_upload_file, $this->_full_url, $this->_image_quality ) ) {
				// Сохраняем размер загруженного изображения в свойство.
				$this->_totalsize();
				// Освобождаем память.
				imagedestroy( $this->_new_upload_file );
			}
			else {
				$this->getController()->Flash->error( __('Ошибка при создании директории!') );
			}
		}
	}

	/**
	 * Записывает данные о файле в БД.
	 */
	protected function _saveFileBD()
	{
		// Данные, которые необходимо записать в ТБ БД.
		if ( $this->_album ) $data['album_id'] = $this->_album;
		$data['filename'] = preg_replace('/\.\w+$/i', '', $this->_file->getClientFilename());// Удаляем расширение файла.
		$data['url'] = $this->_url;
		$data['filemime'] = $this->_file->getClientMediaType();
		$data['filesize'] = $this->_totalSize;
		$data['k'] = round( $this->_k, 4 );
		$data['password_id'] = 2;
		$data['status'] = $this->_status;

		// Записываем данные в ТБ БД.
		$myfile = $this->getController()->Files->newEmptyEntity();
		$myfile = $this->getController()->Files->patchEntity( $myfile, $data, ['validate' => false] );
		// Проверяем на наличие ошибок.
		if ( $this->getController()->Files->save( $myfile ) ) {
         	$this->getController()->Flash->success( __('Файл успешно записан в БД!') );
         	// Запоминаем id загруженного файла.
			$this->_fid[] = $myfile->id;
      	}
      	else $this->getController()->Flash->error( __('Ошибка!') );
		// Обнуляем размер загруженного изображения для одного цикла.
		$this->_totalSize = NULL;
	}

	/**
	 * Масштабирует изображение по большей стороне.
	 */
	protected function _zoomScrMaxWH()
	{
		// Высота и ширина исходного изображения.
		$height = $this->_height;
		$width = $this->_width;
		// Новые значения высоты и ширины изображения.
		$new_height = $this->_new_height;
		$new_width = $this->_new_width;
		// Подсчитываем коэффициент масштаба.
		$k = $height / $width;
		// Пересчитываем координаты копирования изображения.
		$L = max( $width, $height );
		// Если высота фотографии больше ширины и фотография не имеет равные стороны:
		if ( $L == $height and $width != $height ) $new_width =  floor($new_height / $k);
		// ... иначе, ширина фотографии больше высоты и фотография не имеет равные стороны.
		elseif ( $L == $width and $width != $height ) $new_height = floor($new_width * $k);
		// Создаём основу для новой фотографии.
		$scr_new = imagecreatetruecolor( (int)$new_width, (int)$new_height );
		// Сохраняем в свойствах значения ширины и высоты изображения.
		$this->_new_height = $new_height;
		$this->_new_width = $new_width;
		// Копируем изображение с изменёнными размерами.
		imagecopyresampled( $scr_new, $this->_upload_file, 0, 0, 0, 0, (int)$new_width, (int)$new_height, (int)$width, (int)$height );
		// Копируем полученное изображение в свойство.
		$this->_new_upload_file = $scr_new;
	}

	/**
	 * Масштабирует и вписывает фотографию по строго определённым размерам.
	 */
	protected function _zoomScrCropWH() {
		// Высота и ширина исходного изображения.
		$height = $this->_height;
		$width = $this->_width;
		// Новые значения высоты и ширины изображения.
		$new_height = $this->_new_height;
		$new_width = $this->_new_width;
		// Пересчитываем координаты копирования изображения.
		$x_ratio = $width / $new_width;
		$y_ratio = $height / $new_height;
		$ratio = min( $x_ratio, $y_ratio );
		$use_x_ratio = ( $x_ratio == $ratio );
		$new_width_ = $use_x_ratio  ? $width  : floor( $new_width * $ratio );
		$new_height_ = !$use_x_ratio ? $height : floor( $new_height * $ratio );
		$new_left = $use_x_ratio  ? 0 : floor( ( $width - $new_width_ ) / 2 );
		$new_top = !$use_x_ratio ? 0 : floor( ( $height - $new_height_ ) / 2 );
		// Создаём основу для новой картинки (фотографии).
		$scr_new = imagecreatetruecolor( $new_width, $new_height );
		// Сохраняем в свойствах значения ширины и высоты изображения.
		$this->_new_height = $new_height;
		$this->_new_width = $new_width;
		// Копируем изображение с изменёнными размерами.
		imagecopyresampled( $scr_new, $this->_upload_file, 0, 0, (int)$new_left, (int)$new_top, (int)$new_width, (int)$new_height, (int)$new_width_, (int)$new_height_ );
		// Копируем полученное изображение в свойство.
		$this->_new_upload_file = $scr_new;
	}

	/**
	 * Сохраняет размеры файла в свойство. Если в качестве файла используется картинка, то свойство будет содержать
	 * общий размер для всех преобразований изображения.
	 */
	protected function _totalsize()
	{
		$size = filesize( $this->_full_url );
		if ( $this->_totalSize ) $this->_totalSize = $this->_totalSize + $size;
		else $this->_totalSize = $size;
		$this->_totalSizeFiles[] = $size;
	}

	/**
	 * Возвращает массив fid загруженных файлов за одну сессию.
	 */
	public function fid()
	{
		return $this->_fid;
	}

	/**
	 * Возвращает размер в байтах всех загруженных файлов за одну сессию. Если загружалось изображение, то для каждого преобразования
	 * размер указывается отдельно.
	 */
	public function totalSize()
	{
		return $this->_totalSizeFiles;
	}

	/**
	 * Сохранение в сессию путей последних загруженных фотографий.
	 */
	public function saveLastPhotos()
	{
		if ( $this->_request->is( 'post' ) ) {
			$session = $this->getController()->getRequest()->getSession();
			if ( $session->check( 'Lastphotos.upload' ) ) {
				$session->delete( 'Lastphotos.upload' );
			}
			$session->write(['Lastphotos.upload' => array_unique($this->_urls)]);
		}
	}

	/**
	 * Возвращает пути к только что загруженным картинкам.
	 *
	 * @param {string} $format Формат картинки, например, "big" или "small".
	 * @return {array} Путь до картинки.
	 */
	public function urlsImages( $format )
	{
		if ( !$this->_urls ) return null;

		foreach (array_unique($this->_urls) as $key => $value) {
			$new_array[] = '/img/' . $format . '-' . $value;
		}
		return $new_array;
	}

}
