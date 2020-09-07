<?php
/**
 * Menu-top
 */
?>

<ul class="list-link list-link_direction_horizontal menu-top menu-top_theme_standart">
  <li class="list-link__li menu-top__li">
    <?php echo $this->Html->link('Почему "безопасные знакомства"?', '/hhhhhh', ['class' => 'link menu-top__link', 'target' => '_blank']) ?>
  </li>
  <li class="list-link__li menu-top__li">
    <?php echo $this->Html->link('"Безопасные встречи"- это как?', '/hhhhhh', ['class' => 'link menu-top__link', 'target' => '_blank']) ?>
  </li>
  <li class="list-link__li menu-top__li"></li>
  <li class="list-link__li menu-top__li">
    <?php echo $this->Html->link('Ссылка 2', '/hhhhhh', ['class' => 'link menu-top__link', 'target' => '_blank']) ?>
  </li>
</ul>

<?php echo $this->Html->css('Lovesafe.menu-top', ['block' => false]); ?>
