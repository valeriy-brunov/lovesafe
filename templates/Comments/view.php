<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $comment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Comment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="comments view content">
            <h3><?= h($comment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('File') ?></th>
                    <td><?= $comment->has('file') ? $this->Html->link($comment->file->id, ['controller' => 'Files', 'action' => 'view', $comment->file->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= $comment->has('password') ? $this->Html->link($comment->password->id, ['controller' => 'Passwords', 'action' => 'view', $comment->password->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($comment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($comment->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($comment->text)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
