<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BattleCharacterStatus $battleCharacterStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $battleCharacterStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $battleCharacterStatus->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Battle Character Statuses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleCharacterStatuses form content">
            <?= $this->Form->create($battleCharacterStatus) ?>
            <fieldset>
                <legend><?= __('Edit Battle Character Status') ?></legend>
                <?php
                        echo 'チャットキャラクターID';                    echo $this->Form->control('chat_character_id');
                        echo 'レベル';                    echo $this->Form->control('level');
                        echo '腕力';                    echo $this->Form->control('strength');
                        echo '敏捷';                    echo $this->Form->control('dexterity');
                        echo '体力';                    echo $this->Form->control('stamina');
                        echo '精神';                    echo $this->Form->control('spirit');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
