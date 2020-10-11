<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $password
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $password->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $password->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Passwords'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="passwords form content">
            <?= $this->Form->create($password) ?>
            <fieldset>
                <legend><?= __('Edit Password') ?></legend>
                <?php
                    echo $this->Form->control('pass');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
