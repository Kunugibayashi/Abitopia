<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Information> $informations
 */
?>
<div class="informations index content">
    <?= $this->Html->link(__('New Information'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Informations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($informations as $information): ?>
                <tr>
                    <td><?= $this->Number->format($information->id) ?></td>
                    <td><?= h($information->title) ?></td>
                    <td><?= h($information->modified) ?></td>
                    <td><?= h($information->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $information->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $information->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $information->id], ['confirm' => __('Are you sure you want to delete # {0}?', $information->id)]) ?>
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