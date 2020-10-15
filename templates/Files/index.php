<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>

<?php echo $this->element('Lovesafe.modal-window', [
	'name' => 'big_photo',
	'class_block' => 'preview-big-photo',
	'content' => '
		<div class="preview-big-photo__img" style="background-image: url()"></div>
		<a href="#" class="preview-big-photo__nextphoto">следующее</a>
		<a href="#" class="preview-big-photo__prevphoto">предыдущее</a>
	' . $this->element('loader', ['add_class' => 'loader_theme_big-photo preview-big-photo__loader']),
	'data_bem' => '{ "preview-big-photo":{} }',
]) ?>

<!-- Имя пользователя. -->
<?php $this->start('paneltitle') ?>
  Валерий
<?php $this->end() ?>

<?php echo $this->element('Lovesafe.panel', [
	'panel' => [
		'paneltitle' => [8, '_display_hide'],
	],
]) ?>

<!-- Закладки. -->
<?php $this->start('panelbookmark') ?>
  <?php
	  echo $this->element('Lovesafe.bookmark', [
	    'link' => [
	      $this->Html->link('Моя анкета', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
	      $this->Html->link('Мои фотографии', '/hhhhhh', ['class' => 'bookmark__href bookmark__href_current', 'target' => '_blank']),
	      $this->Html->link('Чёрный список', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
	      $this->Html->link('Мой счёт', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
	      $this->Html->link('Статистика', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
	    ],
	  ]);
	?>
<?php $this->end() ?>

<?php echo $this->element('Lovesafe.panel', [
	'panel' => [
		'panelbookmark' => [8, '_theme_bookmark'],
	],
]) ?>

<!-- Панель для загрузки файлов2. -->
<?php $this->start('uploadfiles') ?>

		Загрузите фотографии&nbsp;
	  	<?php echo $this->Html->link('с компьютера&nbsp;<i class="icons icons_desktop2 icons_size_big"></i>', '#', [
			'class' => 'button uploadfiles__button-change-files',
			'escapeTitle' => false,
	  	]) ?>
	  	&nbsp;
	  	<?php echo $this->Html->link('из ВКонтакте&nbsp;<i class="icons icons_vk icons_size_big"></i>', '#', [
			'class' => 'button uploadfiles-panel-left__button-upload',
			'escapeTitle' => false,
	  	]) ?>
	  	&nbsp;
	  	<?php echo $this->Html->link('Другие способы загрузки&nbsp;<i class="icons icons_caret-down icons_size_small"></i>', '#', [
			'class' => 'button button_theme_white uploadfiles-panel-left__button-upload',
			'escapeTitle' => false,
	  	]) ?>

<?php $this->end() ?>

<!-- Индикатор загрузки файлов. -->
<?php $this->start('indicator_uploadfiles') ?>

	<div class="uploadfiles__indicator">
		<span class="uploadfiles__proc">0%</span>
		<div class="uploadfiles__color"></div>
	</div>

<?php $this->end() ?>

<!-- Количество фотографий. -->
<?php $this->start('countphoto') ?>
  <span class="fonts fonts_bold">Мои фотографии (<?= $count_images ?>)</span>
<?php $this->end() ?>

<!-- Панель, содержащая внутренние панели. -->
<?php $this->start('myphotos') ?>

	<?php echo $this->element('Lovesafe.uploadfiles', [
		'start_end_form' => true,
		'label_submit' => 'Загрузить',
		'class' => 'uploadfiles__form',
	]) ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'uploadfiles-panel uploadfiles__button',
		'panel' => [
			'uploadfiles' => [8, 'uploadfiles-panel__submit-upload'],
		]
	]) ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'uploadfiles__indicator-upload',
		'panel' => [
			'indicator_uploadfiles' => [8],
		]
	]) ?>

	<!-- Количество фотографий -->
	<?php echo $this->element('Lovesafe.panel', [
		'panel' => [
			'countphoto' => [8, '_display_hide'],
		],
	]) ?>

	<!-- Листинг фотографий. -->
	<?php echo $this->element('Lovesafe.previewphoto', [
		'obj_images' => (isset($obj_images) and count($obj_images)) ? $obj_images : null,
	]) ?>

<?php $this->end() ?>

<?php echo $this->element('Lovesafe.panel', [
	'panel_class' => 'uploadfiles uploadfiles_display_formupload i-bem',
	'data_bem' => '{ "uploadfiles":{} }',
	'panel' => [
		'myphotos' => [8],
	]
]) ?>
