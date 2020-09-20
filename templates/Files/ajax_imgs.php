<?php
/**
 * Листинг фотографий при помощи ajax.
 */
?>

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

	<?php echo $this->element('Lovesafe.panel', [
		'panel' => $panel,
		'add_class_panel_col' => 'previewphoto__panel',
		'wrap' => 1,
		'addstarthtml' => '<div class="paste__delete paste__delete_hide"></div>',
	]) ?>

<?php endif; ?>
