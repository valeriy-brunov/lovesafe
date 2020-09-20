<?php
/**
 * Панель (обёртка) для содержимого.
 *
 * <?php $this->start('panel1') ?>
 * ...содержимое
 * <?php $this->end() ?>
 * <?php $this->start('panel2') ?>
 * ...содержимое
 * <?php $this->end() ?>
 * <?php echo $this->element('Lovesafe.panel', ['panel' => ['panel1' => [3], 'panel2' => [3, '_display_square text'] ]]) ?>
 *
 * ['panel' => ['имя_панели (берётся из $this->start('mypanel'))' => [ширина_панели, классы_модификаторы через пробел (можно не указывать)], .....]]
 *
 * Если класс модификатора начинается с символа "_" (подчёркивание), то модификатор добавляется к имени элемента.
 * Если класс модификатора не начинается с символа "_" (подчёркивание), то модификатор добавляется целиком, ввиде строки.
 *
 * @param {string} $add_class_panel_col
 *		Класс для каждого элемента panel__col-*
 * @param {string} $panel_class
 *		Дополнительный класс к классу оболочки панели "panel".
 * @param {string} $attr
 *		Дополнительные атрибуты.
 * @param {json} $data_bem
 *		Добавляет атрибут "data-bem". Например: 'data_bem' => '{ "uploadfiles":{} }'
 * @param {boolean} $wrap
 * 		0 - показать оболочку и содержимое оболочки (по умолчанию);
 * 		1 - убрать оболочку, оставить только содержимое оболочки;
 * 		2 - оставить только оболочку, убрать содержимое оболочки.
 * 		Примечание: здесь под оболочкой понимается внешний слой с класом panel.
 * @param {string} $addstarthtml
 * 		Добавление дополнительной вёрстки html в начало панели.
 * @param {string} $addendhtml
 * 		Добавление вёрстки html в конец панели.
 */
?>

<?php if ( !isset($wrap) ) $wrap = 0; ?>

<?php if ( $wrap === 0 or $wrap === 2 ): ?>
<div class="panel<?= isset($panel_class) ? ' ' . $panel_class : '' ?>"<?= isset($attr) ? ' ' . $attr : '' ?><?= isset($data_bem) ? ' data-bem=' . '\'' . $data_bem . '\'': '' ?>>
<?php endif; ?>

	<?php if ( isset($addstarthtml) ) echo $addstarthtml ?>

	<?php if ( $wrap === 0 or $wrap === 1 ): ?>
	<?php foreach ( $panel as $name_panel => $val ): ?>
		<div class="panel__col-<?= $val[0] ?>
		<?php
			if ( isset($val[1]) ) {
				$arr = explode( " ", $val[1] );
				$class = [];
				foreach ( $arr as $key => $value ) {
					if ( substr($value, 0, 1) == '_' ) {
						$class[] = ' panel__col-' . $val[0] . $value;
					}
					if ( substr($value, 0, 1) != '_' ) {
						$class[] = $value;
					}
				}
				$val[1] = implode( " ", $class );
			}
		?>
		<?= isset($val[1]) ? $val[1] : '' ?>
		<?= isset($add_class_panel_col) ? ' ' . $add_class_panel_col : '' ?>">
			<?= $this->fetch($name_panel) ?>
		</div>
	<?php endforeach; ?>
	<?php endif; ?>

	<?php if ( isset($addendhtml) ) echo $addendhtml ?>

<?php if ( $wrap === 0 or $wrap === 2 ): ?>
</div>
<?php endif; ?>

<?php if ( $wrap === 0 or $wrap === 2 ): ?>
<?php echo $this->Html->css('Lovesafe.panel', ['block' => true]) ?>

<?php
	if (isset($data_bem)) {
		$obj = json_decode($data_bem);
		foreach ((array)$obj as $key => $value) {
			echo $this->Html->script('Lovesafe.' . $key, ['block' => true]);
		}
    }
?>
<?php endif; ?>
