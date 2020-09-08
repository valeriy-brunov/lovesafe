<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>
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

<!-- Панель для загрузки файлов. -->
<?php $this->start('panelright') ?>

	<div class="uploadfiles-panel-right">

	  <div class="uploadfiles-panel-right__text fonts fonts_size_large">
	  	<i class="icons icons_arm icons_size_big"></i>&nbsp;&nbsp;или перетащите фотографии сюда
	  </div>

		<?php
			echo $this->element('Lovesafe.uploadfiles', [
			    'start_end_form' => [
			        'action' => '',
			    ],
			    'label_upload_file' => 'Выбрать файл',
			    'label_submit' => 'Загрузить',
			    'class' => 'uploadfiles-panel-right__form',
			]);
		?>

	</div>

<?php $this->end() ?>

<?php $this->start('panelleft') ?>
  <div class="uploadfiles-panel-left">
  	<div class="uploadfiles-panel-left__icon"><i class="icons icons_desktop2 icons_size_large"></i></div>
  	<div class="uploadfiles-panel-left__text">загрузить</div>
  	<div class="uploadfiles-panel-left__text">фотографии</div>
  	<div class="uploadfiles-panel-left__button"><?php echo $this->Form->button('с компьютера', ['type' => 'button']) ?></div>
  </div>
<?php $this->end() ?>

<!-- Индикатор загрузки фотографий. -->
<?php $this->start('panelindicator') ?>
вакуупупу
<?php $this->end() ?>

<?php echo $this->element('Lovesafe.panel', [
	'panel_class' => 'uploadfiles uploadfiles_display_formupload i-bem',
	'data_bem' => '{ "uploadfiles":{} }',
	'panel' => [
		'panelleft' => [2, '_display_square _direction_center'],
		'panelright' => [6, '_direction_center'],
		'panelindicator' => [8, 'uploadfiles__indicator'],
	]
]) ?>

<!-- Листинг фотографий. -->
<?php echo $this->element('Lovesafe.previewphoto', [
	'urls_images' => (isset($urls_images) and $urls_images) ? $urls_images : null,
]) ?>
