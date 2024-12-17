<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SiteSystemConfig $siteSystemConfig
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Site System Config'), ['action' => 'edit', $siteSystemConfig->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Site System Config'), ['action' => 'delete', $siteSystemConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $siteSystemConfig->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Site System Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Site System Config'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="siteSystemConfigs view content">
            <h3><?= h($siteSystemConfig->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($siteSystemConfig->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Site Rule Code') ?></th>
                    <td><?= $this->Number->format($siteSystemConfig->site_rule_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active Flag') ?></th>
                    <td><?= $this->Number->format($siteSystemConfig->active_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($siteSystemConfig->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($siteSystemConfig->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>