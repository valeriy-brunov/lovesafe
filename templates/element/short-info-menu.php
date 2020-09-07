<?php
/**
 * short-info-menu
 */
?>

<ul class="list-link list-link_direction_vertical short-info-menu">

  <li class="list-link__li short-info-menu__cell">
    <i class="icons icons_mail-double short-info-menu__icon"></i>
    <div class="short-info-menu__count">+22</div>
    <div class="short-info-menu__description">Сообщения</div>
  </li>

  <li class="list-link__li short-info-menu__cell">
    <i class="icons icons_alert-double short-info-menu__icon"></i>
    <div class="short-info-menu__count">+22</div>
    <div class="short-info-menu__description">События</div>
  </li>

  <li class="list-link__li short-info-menu__cell">
    <i class="icons icons_eyes-double short-info-menu__icon"></i>
    <div class="short-info-menu__count">+2</div>
    <div class="short-info-menu__description">Просмотры</div>
  </li>

</ul>

<?php echo $this->Html->css('Lovesafe.short-info-menu', ['block' => false]); ?>
