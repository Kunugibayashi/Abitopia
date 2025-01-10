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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $battleRuleConfig->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $battleRuleConfig->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Battle Rule Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleRuleConfigs form content">
            <?= $this->Form->create($battleRuleConfig) ?>
            <fieldset>
                <legend><?= __('Edit Battle Rule Config') ?></legend>
                <?php
                    echo '戦闘ルールコード';
                    echo $this->Form->control('battle_rule_code');
                    echo '有効フラグ';
                    echo $this->Form->control('active_flag');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
