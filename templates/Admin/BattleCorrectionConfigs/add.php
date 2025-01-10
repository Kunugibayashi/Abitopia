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
            <?= $this->Html->link(__('List Battle Correction Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleCorrectionConfigs form content">
            <?= $this->Form->create($battleCorrectionConfig) ?>
            <fieldset>
                <legend><?= __('Add Battle Correction Config') ?></legend>
                <?php
                    echo '戦闘補正値コード';
                    echo $this->Form->control('battle_correction_code');
                    echo '戦闘補正値';
                    echo $this->Form->control('battle_correction_value');
                    echo '有効フラグ（0：デフォルト  1：戦闘補正値を適応）';
                    echo $this->Form->control('active_flag');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
