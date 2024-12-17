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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $siteSystemConfig->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $siteSystemConfig->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Site System Configs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="siteSystemConfigs form content">
            <?= $this->Form->create($siteSystemConfig) ?>
            <fieldset>
                <legend><?= __('Edit Site System Config') ?></legend>
                <?php
                        echo 'サイトルールコード';                    echo $this->Form->control('site_rule_code');
                        echo '有効フラグ';                    echo $this->Form->control('active_flag');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
