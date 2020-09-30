<?php
/**
 * Листинг фотографий при помощи ajax.
 */
?>

<?php $this->Paginator->setTemplates([
	'nextActive' => '
		<div class="paste2__delete paste2__delete_hide paste2__delete paginator__page">
			<input type="hidden" name="page" value="{{url}}">
		</div>',
	'nextDisabled' => '',
]) ?>

<?php if ( isset($obj_images) and count($obj_images) ): ?>

	<?php $i = 0; ?>
	<?php foreach ($obj_images as $obj_image): ?>
		<?php $name = 'previewphoto' . $i; ?>
		<?php $this->start($name) ?>
			<div class="previewphoto__photo controllerfiles__previewphoto-photo" style="background-image: url('<?= $this->Url->build($obj_image->small_url, ['fullBase' => true]) ?>')" data-fid="<?= $obj_image->id ?>"></div>
		<?php $this->end() ?>
		<?php $panel[$name] = [2, '_display_square switch-visibility-blocks__one']; ?>
		<?php $i++; ?>
	<?php endforeach; ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel' => $panel,
		'add_class_panel_col' => 'previewphoto__panel',
		'wrap' => 1,
		'addendhtml' => $this->Paginator->next(),
	]) ?>

<?php endif; ?>
