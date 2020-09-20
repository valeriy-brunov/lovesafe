<!-- Начало формы. -->
<?php if ( $start_end_form ): ?>
	<?= $this->Form->create(null, [
		'type' => 'file',
		'url' => [
			'action' => $start_end_form['action']],
			'id' => 'myfiles-upload',
			'class' => (isset($class)) ? $class : 'myfiles-upload',
		])?>
<?php endif; ?>

<?php
	// Форма загрузки файла.
	echo $this->Form->control('myfile[]', [
			'type' => 'file',
			'multiple' => true,// Форма multiple.
			'label' => (isset($label_upload_file)) ? $label_upload_file : '',
			'class' => 'uploadfiles__input',
		]);

	// Кнопка "Загрузить".
	if (isset($label_submit)) {
		echo $this->Form->control($label_submit, [
			'type' => 'submit',
			'id' => 'submit',
			'class' => 'uploadfiles__submit',
		]);
	}
?>

<?php if ( $start_end_form ): ?>
	<?= $this->Form->end() ?>
	<!-- Конец формы. -->
<?php endif; ?>
