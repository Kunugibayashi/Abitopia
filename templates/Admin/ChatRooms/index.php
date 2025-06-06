<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ChatRoom> $chatRooms
 */
?>
<div class="chatRooms index content">
    <?= $this->Html->link(__('New Chat Room'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Chat Rooms') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('design') ?></th>
                    <th><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('readonly') ?></th>
                    <th><?= $this->Paginator->sort('displayno') ?></th>
                    <th><?= $this->Paginator->sort('omikuji1flg') ?></th>
                    <th><?= $this->Paginator->sort('omikuji1name') ?></th>
                    <th><?= $this->Paginator->sort('omikuji2flg') ?></th>
                    <th><?= $this->Paginator->sort('omikuji2name') ?></th>
                    <th><?= $this->Paginator->sort('deck1flg') ?></th>
                    <th><?= $this->Paginator->sort('deck1name') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chatRooms as $chatRoom): ?>
                <tr>
                    <td><?= $this->Number->format($chatRoom->id) ?></td>
                    <td><?= h($chatRoom->title) ?></td>
                    <td><?= $this->Number->format($chatRoom->design) ?></td>
                    <td><?= $this->Number->format($chatRoom->published) ?></td>
                    <td><?= $this->Number->format($chatRoom->readonly) ?></td>
                    <td><?= $this->Number->format($chatRoom->displayno) ?></td>
                    <td><?= $this->Number->format($chatRoom->omikuji1flg) ?></td>
                    <td><?= h($chatRoom->omikuji1name) ?></td>
                    <td><?= $this->Number->format($chatRoom->omikuji2flg) ?></td>
                    <td><?= h($chatRoom->omikuji2name) ?></td>
                    <td><?= $this->Number->format($chatRoom->deck1flg) ?></td>
                    <td><?= h($chatRoom->deck1name) ?></td>
                    <td><?= h($chatRoom->modified) ?></td>
                    <td><?= h($chatRoom->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $chatRoom->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $chatRoom->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $chatRoom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chatRoom->id)]) ?>
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