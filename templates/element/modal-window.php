<?php
/**
 * Шаблон модального окна.
 *
 * @param {string} $name
 *		Имя модального окна. Впоследствии будет использоваться для идентификации при вызове.
 * @param {string} $class_block
 *		Дополнительные классы для модального окна.
 * @param {string} $class_wrap
 *		Класс обёртки модального окна.
 * @param {string} $class_shell
 *		Класс дополнительного шелла модального окна.
 * @param {string} $class_close
 *		Класс ссылки закрытия.
 */
?>

<div class="modal-window<?= isset($class_block) ? ' ' . $class_block : '' ?> i-bem" data-bem='{ "modal-window" : {"name" : "<?= $name ?>"} }'>
	<div class="modal-window__wrap<?= isset($class_wrap) ? ' ' . $class_wrap : '' ?>">
		<div class="modal-window__shell<?= isset($class_shell) ? ' ' . $class_shell : '' ?>">
			<a class="modal-window__close<?= isset($class_close) ? ' ' . $class_close : '' ?>" href="#">Закрыть</a>
			jfjfjf fgnfgfj hhrtjr frjrjrjr
		</div>
	</div>
</div>

<?php echo $this->Html->css('Lovesafe.modal-window', ['block' => true]) ?>
<?php echo $this->Html->script('Lovesafe.modal-window', ['block' => true]) ?>
