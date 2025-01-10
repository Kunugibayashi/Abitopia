<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $battleCorrectionConfigs
 */
?>
<div class="battleCorrectionConfigs index content">
    <?= $this->Html->link(__('New Battle Correction Config'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Battle Correction Configs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('battle_correction_code') ?></th>
                    <th><?= $this->Paginator->sort('battle_correction_value') ?></th>
                    <th><?= $this->Paginator->sort('active_flag') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($battleCorrectionConfigs as $battleCorrectionConfig): ?>
                <tr>
                    <td><?= $this->Number->format($battleCorrectionConfig->id) ?></td>
                    <td><?= $this->Number->format($battleCorrectionConfig->battle_correction_code) ?></td>
                    <td><?= $this->Number->format($battleCorrectionConfig->battle_correction_value) ?></td>
                    <td><?= $this->Number->format($battleCorrectionConfig->active_flag) ?></td>
                    <td><?= h($battleCorrectionConfig->modified) ?></td>
                    <td><?= h($battleCorrectionConfig->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $battleCorrectionConfig->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $battleCorrectionConfig->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $battleCorrectionConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleCorrectionConfig->id)]) ?>
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