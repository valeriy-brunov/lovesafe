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
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Password') ?></th>
                    <td><?= $user->has('password') ? $this->Html->link($user->password->id, ['controller' => 'Passwords', 'action' => 'view', $user->password->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sex') ?></th>
                    <td><?= h($user->sex) ?></td>
                </tr>
                <tr>
                    <th><?= __('Constitution') ?></th>
                    <td><?= h($user->constitution) ?></td>
                </tr>
                <tr>
                    <th><?= __('Eyecolor') ?></th>
                    <td><?= h($user->eyecolor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Haircolor') ?></th>
                    <td><?= h($user->haircolor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Onbody') ?></th>
                    <td><?= h($user->onbody) ?></td>
                </tr>
                <tr>
                    <th><?= __('Relationship') ?></th>
                    <td><?= h($user->relationship) ?></td>
                </tr>
                <tr>
                    <th><?= __('Children') ?></th>
                    <td><?= h($user->children) ?></td>
                </tr>
                <tr>
                    <th><?= __('Housing') ?></th>
                    <td><?= h($user->housing) ?></td>
                </tr>
                <tr>
                    <th><?= __('Car') ?></th>
                    <td><?= h($user->car) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ilooking') ?></th>
                    <td><?= h($user->ilooking) ?></td>
                </tr>
                <tr>
                    <th><?= __('Myincome') ?></th>
                    <td><?= h($user->myincome) ?></td>
                </tr>
                <tr>
                    <th><?= __('Education') ?></th>
                    <td><?= h($user->education) ?></td>
                </tr>
                <tr>
                    <th><?= __('Smoking') ?></th>
                    <td><?= h($user->smoking) ?></td>
                </tr>
                <tr>
                    <th><?= __('Alcohol') ?></th>
                    <td><?= h($user->alcohol) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Town') ?></th>
                    <td><?= $this->Number->format($user->town) ?></td>
                </tr>
                <tr>
                    <th><?= __('Height') ?></th>
                    <td><?= $this->Number->format($user->height) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $this->Number->format($user->weight) ?></td>
                </tr>
                <tr>
                    <th><?= __('Birthday') ?></th>
                    <td><?= h($user->birthday) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Fieldactivity') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->fieldactivity)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Aboutyouself') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($user->aboutyouself)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
