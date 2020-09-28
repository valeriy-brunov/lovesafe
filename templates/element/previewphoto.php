<?php
/**
 * Превью фотографии для не владельца фото.
 */
?>

<?php $this->Paginator->setTemplates([
	'nextActive' => '
		<div class="paste2__delete paste2__delete_hide paste2__delete paginator__page">
			<input type="hidden" name="page" value="{{url}}">
		</div>
		<div class="paste2__trubber paste2__trubber_hide">загрузка...</div>
		<div class="paste2__other paste2__other_hide paginator__object">смотреть ещё...</div>',
	'nextDisabled' => '',
]) ?>

<?php $this->start( 'not_photos' ) ?>
	<div class="not-photos">
		<div>
			-------------------------------------------------------------<br>
			У вас нет загруженных фотографий. Почему? Это ведь безопасно!<br>
			-------------------------------------------------------------
		</div>
	</div>
<?php $this->end() ?>

<?php if ( isset($obj_images) and count($obj_images) ): ?>

	<!-- Если у пользователя есть загруженные фотографии. -->
	<?php $i = 0; ?>
	<?php foreach ($obj_images as $obj_image): ?>
		<?php $name = 'previewphoto' . $i; ?>
		<?php $this->start($name) ?>
			<div class="previewphoto__photo" style="background-image: url('<?= $this->Url->build($obj_image->small_url, ['fullBase' => true]) ?>')" data-fid="<?= $obj_image->id ?>"></div>
		<?php $this->end() ?>
		<?php $panel[$name] = [2, '_display_square switch-visibility-blocks__one']; ?>
		<?php $i++; ?>
	<?php endforeach; ?>

	<?php $panel['not_photos'] = [8, '_display_hide switch-visibility-blocks__two']; ?>

	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'previewphoto uploadfiles__previewphoto switch-visibility-blocks paste paste2 i-bem',
		'add_class_panel_col' => 'previewphoto__panel',
		'panel' => $panel,
		'data_bem' => '{ "paste":{ "channel":"newphoto" }, "paste2":{ "channel":"newpagination" }, "paginator":{ "channel":"newpagination", "channelnext":"nextphoto" }, "controllerfiles":{} }',
		'addstarthtml' => '<div class="paste__delete paste__delete_hide"></div>',
		'addendhtml' => $this->Paginator->next(),
	]) ?>

	<?php echo $this->Html->script('Lovesafe.controllerfiles', ['block' => true]) ?>

<?php else: ?>

	<!-- Если у пользователя нет загруженных фотографий. -->
	<?php echo $this->element('Lovesafe.panel', [
		'panel_class' => 'previewphoto uploadfiles__previewphoto switch-visibility-blocks paste i-bem',
		'add_class_panel_col' => 'previewphoto__panel',
		'panel' => ['not_photos' => [8, '_display_hide switch-visibility-blocks__two']],
		'data_bem' => '{ "paste":{ "channel":"newphoto" } }',
		'addstarthtml' => '<div class="paste__delete paste__delete_hide"></div>',
	]) ?>

<?php endif; ?>

<?php echo $this->Html->css('Lovesafe.previewphoto', ['block' => true]) ?>
