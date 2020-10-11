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
            <?= $this->Html->link(__('Edit Password'), ['action' => 'edit', $password->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Password'), ['action' => 'delete', $password->id], ['confirm' => __('Are you sure you want to delete # {0}?', $password->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Passwords'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Password'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="passwords view content">
            <h3><?= h($password->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Pass') ?></th>
                    <td><?= h($password->pass) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($password->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Comments') ?></h4>
                <?php if (!empty($password->comments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('File Id') ?></th>
                            <th><?= __('Password Id') ?></th>
                            <th><?= __('Text') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($password->comments as $comments) : ?>
                        <tr>
                            <td><?= h($comments->id) ?></td>
                            <td><?= h($comments->file_id) ?></td>
                            <td><?= h($comments->password_id) ?></td>
                            <td><?= h($comments->text) ?></td>
                            <td><?= h($comments->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Comments', 'action' => 'view', $comments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Comments', 'action' => 'edit', $comments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Comments', 'action' => 'delete', $comments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Files') ?></h4>
                <?php if (!empty($password->files)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Password Id') ?></th>
                            <th><?= __('Filename') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Filemime') ?></th>
                            <th><?= __('Filesize') ?></th>
                            <th><?= __('K') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Allow Comments') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($password->files as $files) : ?>
                        <tr>
                            <td><?= h($files->id) ?></td>
                            <td><?= h($files->password_id) ?></td>
                            <td><?= h($files->filename) ?></td>
                            <td><?= h($files->url) ?></td>
                            <td><?= h($files->filemime) ?></td>
                            <td><?= h($files->filesize) ?></td>
                            <td><?= h($files->k) ?></td>
                            <td><?= h($files->status) ?></td>
                            <td><?= h($files->allow_comments) ?></td>
                            <td><?= h($files->created) ?></td>
                            <td><?= h($files->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Files', 'action' => 'view', $files->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Files', 'action' => 'edit', $files->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Files', 'action' => 'delete', $files->id], ['confirm' => __('Are you sure you want to delete # {0}?', $files->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Telephones') ?></h4>
                <?php if (!empty($password->telephones)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Password Id') ?></th>
                            <th><?= __('Tel') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($password->telephones as $telephones) : ?>
                        <tr>
                            <td><?= h($telephones->id) ?></td>
                            <td><?= h($telephones->password_id) ?></td>
                            <td><?= h($telephones->tel) ?></td>
                            <td><?= h($telephones->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Telephones', 'action' => 'view', $telephones->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Telephones', 'action' => 'edit', $telephones->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Telephones', 'action' => 'delete', $telephones->id], ['confirm' => __('Are you sure you want to delete # {0}?', $telephones->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($password->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Password Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Birthday') ?></th>
                            <th><?= __('Town') ?></th>
                            <th><?= __('Height') ?></th>
                            <th><?= __('Weight') ?></th>
                            <th><?= __('Constitution') ?></th>
                            <th><?= __('Eyecolor') ?></th>
                            <th><?= __('Haircolor') ?></th>
                            <th><?= __('Onbody') ?></th>
                            <th><?= __('Relationship') ?></th>
                            <th><?= __('Children') ?></th>
                            <th><?= __('Housing') ?></th>
                            <th><?= __('Car') ?></th>
                            <th><?= __('Ilooking') ?></th>
                            <th><?= __('Myincome') ?></th>
                            <th><?= __('Education') ?></th>
                            <th><?= __('Fieldactivity') ?></th>
                            <th><?= __('Smoking') ?></th>
                            <th><?= __('Alcohol') ?></th>
                            <th><?= __('Aboutyouself') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($password->users as $users) : ?>
                        <tr>
                            <td><?= h($users->id) ?></td>
                            <td><?= h($users->password_id) ?></td>
                            <td><?= h($users->name) ?></td>
                            <td><?= h($users->sex) ?></td>
                            <td><?= h($users->birthday) ?></td>
                            <td><?= h($users->town) ?></td>
                            <td><?= h($users->height) ?></td>
                            <td><?= h($users->weight) ?></td>
                            <td><?= h($users->constitution) ?></td>
                            <td><?= h($users->eyecolor) ?></td>
                            <td><?= h($users->haircolor) ?></td>
                            <td><?= h($users->onbody) ?></td>
                            <td><?= h($users->relationship) ?></td>
                            <td><?= h($users->children) ?></td>
                            <td><?= h($users->housing) ?></td>
                            <td><?= h($users->car) ?></td>
                            <td><?= h($users->ilooking) ?></td>
                            <td><?= h($users->myincome) ?></td>
                            <td><?= h($users->education) ?></td>
                            <td><?= h($users->fieldactivity) ?></td>
                            <td><?= h($users->smoking) ?></td>
                            <td><?= h($users->alcohol) ?></td>
                            <td><?= h($users->aboutyouself) ?></td>
                            <td><?= h($users->created) ?></td>
                            <td><?= h($users->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
