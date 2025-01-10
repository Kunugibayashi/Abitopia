<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $battleRuleConfig
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Battle Rule Config'), ['action' => 'edit', $battleRuleConfig->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Battle Rule Config'), ['action' => 'delete', $battleRuleConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleRuleConfig->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Battle Rule Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Battle Rule Config'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleRuleConfigs view content">
            <h3><?= h($battleRuleConfig->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($battleRuleConfig->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Battle Rule Code') ?></th>
                    <td><?= $this->Number->format($battleRuleConfig->battle_rule_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active Flag') ?></th>
                    <td><?= $this->Number->format($battleRuleConfig->active_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($battleRuleConfig->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($battleRuleConfig->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>