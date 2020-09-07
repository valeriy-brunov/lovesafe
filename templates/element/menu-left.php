<?php echo $this->Html->css('Lovesafe.menu-left', ['block' => false]); ?>

<?php echo $this->element('Lovesafe.listlink', [
  'ul_class' => 'list-link_direction_vertical menu-left menu-left_theme_standart',
  'li' => [
    'li_class' => 'menu-left__li',
    'link' => [
      $this->Html->link('Ссылка 1rrrrrb brrbr', '/hhhhhh', ['class' => 'link menu-left__link', 'target' => '_blank']),
      $this->Html->link('Ссылка 2', '/hhhhhh', ['class' => 'link menu-left__link', 'target' => '_blank']),
      $this->Html->link('Ссылка 2wrw', '/hhhhhh', ['class' => 'link menu-left__link', 'target' => '_blank']),
    ],
  ],
]) ?>
