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
 * <?php echo $this->element('Lovesafe.panel', ['panel' => ['panel1' => [3], 'panel2' => [3, '_display_square _direction_center_'] ]]) ?>
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
 */
?>

<div class="panel panel_theme_standart<?= isset($panel_class) ? ' ' . $panel_class : '' ?>"<?= isset($attr) ? ' ' . $attr : '' ?><?= isset($data_bem) ? ' data-bem=' . '\'' . $data_bem . '\'': '' ?>>
  <?php foreach ( $panel as $name_panel => $val ): ?>
	<div class="panel__col-<?= $val[0] ?>
	<?php
	  if ( isset($val[1]) and substr($val[1], 0, 1) == '_' ) {
	    $arr = explode( " ", $val[1] );
	    if ( is_array($arr) ) $val[1] = ' panel__col-'. $val[0] . implode( ' panel__col-'. $val[0], $arr );
	    else $val[1] = ' panel__col-'. $val[0] . $arr;
	  }
	  elseif ( isset($val[1]) and substr($val[1], 0, 1) != '_' ) {
	  	$arr = explode( " ", $val[1] );
	  	if ( is_array($arr) ) $val[1] = implode( ' ', $arr );
	  	else $val[1] = $arr;
	  }
	?>
	<?= isset($val[1]) ? $val[1] : '' ?>
	<?= isset($add_class_panel_col) ? ' ' . $add_class_panel_col : '' ?>">
		<?= $this->fetch($name_panel) ?>
	</div>
<?php endforeach; ?>
</div>

<?php echo $this->Html->css('Lovesafe.panel', ['block' => true]) ?>

<?php
	if (isset($data_bem)) {
		$obj = json_decode($data_bem);
		foreach ((array)$obj as $key => $value) {
			echo $this->Html->script('Lovesafe.' . $key, ['block' => true]);
		}
  }
?>
