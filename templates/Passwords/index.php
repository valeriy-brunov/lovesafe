<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $passwords
 */
?>
<div class="passwords index content">
    <?= $this->Html->link(__('New Password'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Passwords') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('pass') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($passwords as $password): ?>
                <tr>
                    <td><?= $this->Number->format($password->id) ?></td>
                    <td><?= h($password->pass) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $password->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $password->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $password->id], ['confirm' => __('Are you sure you want to delete # {0}?', $password->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
