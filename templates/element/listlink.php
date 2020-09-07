<?php
/**
 * Универсальный блок "list-link".
 *
 <?php echo $this->element('Lovesafe.listlink', [
   'ul_class' => 'list-link_direction_vertical menu-left',
   'li' => [
     'li_class' => 'menu-left__li',
     'link' => [
       $this->Html->link('Ссылка 2', '/hhhhhh', ['class' => 'link menu-left__link', 'target' => '_blank']),
       $this->Html->link('Ссылка 2wrw', '/hhhhhh', ['class' => 'link menu-left__link', 'target' => '_blank']),
     ],
   ],
 ]) ?>
 */
?>

<ul class="list-link<?= isset($ul_class) ? ' ' . $ul_class : '' ?>">
  <?php for ($i = 0; $i <= count($li['link']) - 1; $i++): ?>
    <li class="list-link__li<?= isset($li['li_class']) ? ' ' . $li['li_class']: '' ?>">
      <?php echo $li['link'][$i] ?>
    </li>
  <?php endfor; ?>
</ul>

<?php echo $this->Html->css('Lovesafe.list-link', ['block' => true]); ?>
