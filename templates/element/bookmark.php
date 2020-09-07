<?php
/**
 * Закладки.
 *
<?php
  echo $this->element('Lovesafe.bookmark', [
    'link' => [
      $this->Html->link('Ссылка 2', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
      $this->Html->link('Ссылка 2', '/hhhhhh', ['class' => 'bookmark__href', 'target' => '_blank']),
    ],
  ]);
?>
 */
?>

<?php echo $this->element('Lovesafe.listlink', [
  'ul_class' => 'list-link_direction_horizontal bookmark',
  'li' => [
    'li_class' => 'bookmark__li',
    'link' => $link,
  ],
]) ?>

<?php echo $this->Html->css('Lovesafe.bookmark', ['block' => true]); ?>
