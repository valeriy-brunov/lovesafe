<?php
declare(strict_types=1);

namespace Lovesafe\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

use Laminas\Diactoros\Stream;

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Lovesafe\Plugin as LovesafePlugin;

/**
 * 
 */
class StreamphotoComponent extends Component
{
	/**
	 * Default configuration.
	 *
	 * @var array
	 */
	protected $_defaultConfig = [];
	
	/**
	 * Выполняем необходимые настройки компонента.
	 */
	public function initialize( array $config ): void
  	{
  		// Cake\Http\Response
  		$this->_response = $this->getController()->getResponse();
  	}

  	/**
  	 * Возвращает поток с изображением.
  	 */
  	public function send( $big_url )
  	{
  		// Загружаем файл конфигурации 'files_default'.
        // use Lovesafe\Plugin as LovesafePlugin;
        $plugin = new LovesafePlugin();
        Configure::config( 'default', new PhpConfig( $plugin->getPath() . 'config/' ) );
        Configure::load( 'upload_files_default' );
        $scrUrl = Configure::read( 'load.scrUrl' );

        $url = explode( '-', $big_url);
        $url_end = $url[0] . DS . $url[1] . DS . $url[2] . DS . $url[3];
        $url_end = str_replace( '/img/', '', $url_end );

        $stream = new Stream( $scrUrl . $url_end, 'rb' );
        // Отключить кеширование.
        $this->_response = $this->_response->withDisabledCache();
        // Заголовок.
        $this->_response = $this->_response->withHeader('Content-type', 'image/jpeg');
        $this->_response = $this->_response->withBody( $stream );

        return $this->_response;
  	}

}
