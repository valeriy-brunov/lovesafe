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
 * @param {string} $content
 *		Содержимое модального окна.
 * @param {json} $data_bem
 *		Добавляет атрибут "data-bem". Например: 'data_bem' => '{ "uploadfiles":{} }'
 */
?>

<?php
	$arr[] = '{"modal-window":{"name":"' . $name . '"}';
	if ( isset($data_bem) ) {
		$arr[] = ',' . trim( substr( trim($data_bem), 1, -1 ) );
	}
	$arr[] = '}';
	$data_bem = implode( '', $arr );
?>

<div class="modal-window<?= isset($class_block) ? ' ' . $class_block : '' ?> i-bem" <?= isset($data_bem) ? ' data-bem=' . '\'' . $data_bem . '\'': '' ?>>
	<div class="modal-window__wrap<?= isset($class_wrap) ? ' ' . $class_wrap : '' ?>">
		<div class="modal-window__shell<?= isset($class_shell) ? ' ' . $class_shell : '' ?>">
			<a class="modal-window__close<?= isset($class_close) ? ' ' . $class_close : '' ?>" href="#">Закрыть</a>
			<?= isset($content) ? $content : '' ?>
		</div>
	</div>
</div>

<?php echo $this->Html->css('Lovesafe.modal-window', ['block' => true]) ?>
<?php echo $this->Html->script('Lovesafe.modal-window', ['block' => true]) ?>

<?php
	if ( isset($data_bem) ) {
		$obj = json_decode( $data_bem );
		foreach ( (array)$obj as $key => $value ) {
			echo $this->Html->script('Lovesafe.' . $key, ['block' => true]);
		}
    }
?>
