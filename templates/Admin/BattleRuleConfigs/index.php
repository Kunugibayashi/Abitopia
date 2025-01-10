<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\Cake\Datasource\EntityInterface> $battleRuleConfigs
 */
?>
<div class="battleRuleConfigs index content">
    <?= $this->Html->link(__('New Battle Rule Config'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Battle Rule Configs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('battle_rule_code') ?></th>
                    <th><?= $this->Paginator->sort('active_flag') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($battleRuleConfigs as $battleRuleConfig): ?>
                <tr>
                    <td><?= $this->Number->format($battleRuleConfig->id) ?></td>
                    <td><?= $this->Number->format($battleRuleConfig->battle_rule_code) ?></td>
                    <td><?= $this->Number->format($battleRuleConfig->active_flag) ?></td>
                    <td><?= h($battleRuleConfig->modified) ?></td>
                    <td><?= h($battleRuleConfig->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $battleRuleConfig->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $battleRuleConfig->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $battleRuleConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleRuleConfig->id)]) ?>
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