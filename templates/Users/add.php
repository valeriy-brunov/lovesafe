<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('password_id', ['options' => $passwords]);
                    echo $this->Form->control('name');
                    echo $this->Form->control('sex');
                    echo $this->Form->control('birthday');
                    echo $this->Form->control('town');
                    echo $this->Form->control('height');
                    echo $this->Form->control('weight');
                    echo $this->Form->control('constitution');
                    echo $this->Form->control('eyecolor');
                    echo $this->Form->control('haircolor');
                    echo $this->Form->control('onbody');
                    echo $this->Form->control('relationship');
                    echo $this->Form->control('children');
                    echo $this->Form->control('housing');
                    echo $this->Form->control('car');
                    echo $this->Form->control('ilooking');
                    echo $this->Form->control('myincome');
                    echo $this->Form->control('education');
                    echo $this->Form->control('fieldactivity');
                    echo $this->Form->control('smoking');
                    echo $this->Form->control('alcohol');
                    echo $this->Form->control('aboutyouself');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
