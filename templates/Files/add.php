<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $file
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Files'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="files form content">
            <?= $this->Form->create($file) ?>
            <fieldset>
                <legend><?= __('Add File') ?></legend>
                <?php
                    echo $this->Form->control('password_id', ['options' => $passwords]);
                    echo $this->Form->control('filename');
                    echo $this->Form->control('url');
                    echo $this->Form->control('filemime');
                    echo $this->Form->control('filesize');
                    echo $this->Form->control('k');
                    echo $this->Form->control('status');
                    echo $this->Form->control('allow_comments');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
