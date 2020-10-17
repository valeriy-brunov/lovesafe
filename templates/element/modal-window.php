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
 * @param {string} $close
 * 		Объект, при нажатие на который модальное окно закрывается.
 * @param {string} $class_close
 *		Дополнительный класс объекта закрытия.
 * @param {string} $content
 *		Содержимое модального окна.
 * @param {string} $data_bem_modal_window
 *		Дополнительные параметры к параметрам "modal-window". Например: 'data_bem_modal_window' => ' "height":"max","width":"max" ',
 * @param {json} $data_bem
 *		Добавляет атрибут "data-bem". Например: 'data_bem' => '{ "uploadfiles":{} }'
 */
?>

<?php
	$arr[] = '{"modal-window":{"name":"' . $name . '"' . (isset($data_bem_modal_window) ? "," . $data_bem_modal_window : "") . '}';
	if ( isset($data_bem) ) {
		$arr[] = ',' . trim( substr( trim($data_bem), 1, -1 ) );
	}
	$arr[] = '}';
	$data_bem = implode( '', $arr );
?>

<div class="modal-window modal-window_display_hide<?= isset($class_block) ? ' ' . $class_block : '' ?> i-bem" <?= isset($data_bem) ? ' data-bem=' . '\'' . $data_bem . '\'': '' ?>>
	<div class="modal-window__wrap<?= isset($class_wrap) ? ' ' . $class_wrap : '' ?>">
		<?php
			if (isset($close)) echo '<div class="modal-window__close">' . $close . '</div>';
			else echo '';
		?>
		<?= isset($content) ? $content : '' ?>
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
