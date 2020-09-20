<?php
/**
 * Превью фотографии для не владельца фото.
 */
?>

<?php $this->start( 'not_photos' ) ?>
	<div class="not-photos">
		<div>
			-------------------------------------------------------------<br>
			У вас нет загруженных фотографий. Почему? Это ведь безопасно!<br>
			-------------------------------------------------------------
		</div>
	</div>
<?php $this->end() ?>

<?php if ( isset($urls_images) and count($urls_images) ): ?>

	<?php $i = 0; ?>
	<?php foreach ($urls_images as $urls_image): ?>
		<?php $name = 'previewphoto' . $i; ?>
		<?php $this->start($name) ?>
			<div class="previewphoto__photo" style="background-image: url('<?= $this->Url->build($urls_image, ['fullBase' => true]) ?>')"></div>
		<?php $this->end() ?>
		<?php $panel[$name] = [2, '_display_square switch-visibility-blocks__one']; ?>
		<?php $i++; ?>
	<?php endforeach; ?>

	<?php $panel['not_photos'] = [8, '_display_hide switch-visibility-blocks__two']; ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'previewphoto uploadfiles__previewphoto switch-visibility-blocks paste i-bem',
		'add_class_panel_col' => 'previewphoto__panel',
		'panel' => $panel,
		'data_bem' => '{ "paste":{ "channel":"newphoto" } }',
		'addstarthtml' => '<div class="paste__delete paste__delete_hide"></div>',
	]) ?>

<?php else: ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'previewphoto uploadfiles__previewphoto switch-visibility-blocks paste i-bem',
		'add_class_panel_col' => 'previewphoto__panel',
		'panel' => ['not_photos' => [8, '_display_hide switch-visibility-blocks__two']],
		'data_bem' => '{ "paste":{ "channel":"newphoto" } }',
		'addstarthtml' => '<div class="paste__delete paste__delete_hide"></div>',
	]) ?>

<?php endif; ?>

<?php echo $this->Html->css('Lovesafe.previewphoto', ['block' => true]) ?>
