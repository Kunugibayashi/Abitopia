<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BattleCharacter $battleCharacter
 * @var string[]|\Cake\Collection\CollectionInterface $battleTurns
 * @var string[]|\Cake\Collection\CollectionInterface $chatCharacters
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $battleCharacter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $battleCharacter->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Battle Characters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleCharacters form content">
            <?= $this->Form->create($battleCharacter) ?>
            <fieldset>
                <legend><?= __('Edit Battle Character') ?></legend>
                <?php
                    echo $this->Form->control('battle_turn_id', ['options' => $battleTurns]);
                    echo $this->Form->control('chat_character_id', ['options' => $chatCharacters]);
                        echo '腕力';                    echo $this->Form->control('strength');
                        echo '敏捷';                    echo $this->Form->control('dexterity');
                        echo '体力';                    echo $this->Form->control('stamina');
                        echo '精神';                    echo $this->Form->control('spirit');
                        echo 'HP';                    echo $this->Form->control('hp');
                        echo 'SP';                    echo $this->Form->control('sp');
                        echo 'コンボ';                    echo $this->Form->control('combo');
                        echo '連続攻撃回数';                    echo $this->Form->control('continuous_turn_count');
                        echo '覚醒したか？';                    echo $this->Form->control('is_limit');
                        echo '覚醒スキルコード';                    echo $this->Form->control('limit_skill_code');
                        echo '恒久腕力補正';                    echo $this->Form->control('permanent_strength');
                        echo '一時腕力補正';                    echo $this->Form->control('temporary_strength');
                        echo '恒久命中率補正';                    echo $this->Form->control('permanent_hit_rate');
                        echo '一時命中率補正';                    echo $this->Form->control('temporary_hit_rate');
                        echo '恒久回避率補正';                    echo $this->Form->control('permanent_dodge_rate');
                        echo '一時回避率補正';                    echo $this->Form->control('temporary_dodge_rate');
                        echo '防御スキルコード';                    echo $this->Form->control('defense_skill_code');
                        echo '防御スキル属性';                    echo $this->Form->control('defense_skill_attribute');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
