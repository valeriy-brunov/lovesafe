<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index content">
    <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('password_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('sex') ?></th>
                    <th><?= $this->Paginator->sort('birthday') ?></th>
                    <th><?= $this->Paginator->sort('town') ?></th>
                    <th><?= $this->Paginator->sort('height') ?></th>
                    <th><?= $this->Paginator->sort('weight') ?></th>
                    <th><?= $this->Paginator->sort('constitution') ?></th>
                    <th><?= $this->Paginator->sort('eyecolor') ?></th>
                    <th><?= $this->Paginator->sort('haircolor') ?></th>
                    <th><?= $this->Paginator->sort('onbody') ?></th>
                    <th><?= $this->Paginator->sort('relationship') ?></th>
                    <th><?= $this->Paginator->sort('children') ?></th>
                    <th><?= $this->Paginator->sort('housing') ?></th>
                    <th><?= $this->Paginator->sort('car') ?></th>
                    <th><?= $this->Paginator->sort('ilooking') ?></th>
                    <th><?= $this->Paginator->sort('myincome') ?></th>
                    <th><?= $this->Paginator->sort('education') ?></th>
                    <th><?= $this->Paginator->sort('smoking') ?></th>
                    <th><?= $this->Paginator->sort('alcohol') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= $user->has('password') ? $this->Html->link($user->password->id, ['controller' => 'Passwords', 'action' => 'view', $user->password->id]) : '' ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->sex) ?></td>
                    <td><?= h($user->birthday) ?></td>
                    <td><?= $this->Number->format($user->town) ?></td>
                    <td><?= $this->Number->format($user->height) ?></td>
                    <td><?= $this->Number->format($user->weight) ?></td>
                    <td><?= h($user->constitution) ?></td>
                    <td><?= h($user->eyecolor) ?></td>
                    <td><?= h($user->haircolor) ?></td>
                    <td><?= h($user->onbody) ?></td>
                    <td><?= h($user->relationship) ?></td>
                    <td><?= h($user->children) ?></td>
                    <td><?= h($user->housing) ?></td>
                    <td><?= h($user->car) ?></td>
                    <td><?= h($user->ilooking) ?></td>
                    <td><?= h($user->myincome) ?></td>
                    <td><?= h($user->education) ?></td>
                    <td><?= h($user->smoking) ?></td>
                    <td><?= h($user->alcohol) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
