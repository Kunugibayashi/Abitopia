<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SiteSystemConfig> $siteSystemConfigs
 */
?>
<div class="siteSystemConfigs index content">
    <?= $this->Html->link(__('New Site System Config'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Site System Configs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('site_rule_code') ?></th>
                    <th><?= $this->Paginator->sort('active_flag') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($siteSystemConfigs as $siteSystemConfig): ?>
                <tr>
                    <td><?= $this->Number->format($siteSystemConfig->id) ?></td>
                    <td><?= $this->Number->format($siteSystemConfig->site_rule_code) ?></td>
                    <td><?= $this->Number->format($siteSystemConfig->active_flag) ?></td>
                    <td><?= h($siteSystemConfig->modified) ?></td>
                    <td><?= h($siteSystemConfig->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $siteSystemConfig->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $siteSystemConfig->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $siteSystemConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $siteSystemConfig->id)]) ?>
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