<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $battleCorrectionConfig
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Battle Correction Config'), ['action' => 'edit', $battleCorrectionConfig->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Battle Correction Config'), ['action' => 'delete', $battleCorrectionConfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleCorrectionConfig->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Battle Correction Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Battle Correction Config'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleCorrectionConfigs view content">
            <h3><?= h($battleCorrectionConfig->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($battleCorrectionConfig->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Battle Correction Code') ?></th>
                    <td><?= $this->Number->format($battleCorrectionConfig->battle_correction_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Battle Correction Value') ?></th>
                    <td><?= $this->Number->format($battleCorrectionConfig->battle_correction_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Active Flag') ?></th>
                    <td><?= $this->Number->format($battleCorrectionConfig->active_flag) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($battleCorrectionConfig->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($battleCorrectionConfig->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>