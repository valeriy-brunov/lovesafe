<?php
/**
 * Файл конфигурации.
 */
return [
	/**
	 * Место, куда будут загружаться файлы.
	 */
	'load' => [
		// Месторасположение файлов.
		// Изображения.
        'scrBaseUrl' => 'http://localhost/lovesafe4_0.loc' . DS,// Домен или поддомен для фотографий.
        'scrUrl' => ROOT . DS . 'logs' . DS,// Место, где располагаются на сервере фотографии.
        'scrExt' => ['jpeg', 'jpg', 'bmp', 'gif', 'jp2', 'png', 'tiff'],// Расширения файлов, которые будем хранить в вышеуказанной директории.
	],

	/**
     * Конфигурация создания размеров загруженных фотографий.
     * Данная настройка конфигурации очень тесно связана с файлом-сущности FullurlscrTrait.php. Любые изменения настройки конфигурации
     * необходимо отражать в файле-сущности FullurlscrTrait.php.
     */
    'scr' => [
        // Настройка для оригинальной фотографии, размеры оригинала после загрузки.
        'big' => [// Поддиректория для сохранения.
            'zoom' => 'MaxWH',// Метод создания превью фотографии. Метод Max-WH масштабирует фотографию по большей строне. 
            'width' => 800,// Максимальная ширина.
            'height' => 600,// Максимальная высота.
        ],
        // Настройки для других форматов.
        'small' => [// Поддиректория для сохранения.
            'zoom' => 'CropWH',// Метод создания превью фотографии. Метод WH масштабирует и вписывает фотографию по строго определённым размерам.
            'width' => 200,
            'height' => 200,
        ],
    ],
    
    /**
     * Все возможные расширения файлов.
     */
    'ext' => [
	    // Изображения.
	  'jpeg' => [
			'image/jpeg',
			'image/jpg',
			'image/pjpeg',
		],
		'bmp' => [
			'image/bmp',
			'image/x-bmp',
			'image/x-bitmap',
			'image/x-xbitmap',
			'image/x-win-bitmap',
			'image/x-windows-bmp',
			'image/ms-bmp',
			'image/x-ms-bmp',
			'application/x-win-bitmap',
			'application/bmp',
			'application/x-bmp',
		],
		'gif' => [
			'image/gif'
		],
		'jp2' => [
			'image/jp2',
			'video/mj2',
			'image/jpx',
			'image/jpm',
		],
		'png' => [
			'image/png',
			'image/x-png',
		],
		'tiff' => [
			'image/tiff'
		],
		// Видео.
		'mp4' => [
			'video/mp4',
			'video/mpeg',
			'video/quicktime',
			'video/x-flv',
		],
		// Аудио.
		'midi' => [
			'audio/midi'
		],
		'mp2' => [
			'audio/mpeg'
		],
		'mp3' => [
			'audio/mp3'
		],
		'wav' => [
			'audio/wav',
			'audio/x-wav',
		],
		'aif' => [
			'audio/x-aiff',
			'audio/aiff',
		],
  ],

];
