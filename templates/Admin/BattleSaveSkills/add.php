<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BattleSaveSkill $battleSaveSkill
 * @var \Cake\Collection\CollectionInterface|string[] $battleTurns
 * @var \Cake\Collection\CollectionInterface|string[] $chatCharacters
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Battle Save Skills'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleSaveSkills form content">
            <?= $this->Form->create($battleSaveSkill) ?>
            <fieldset>
                <legend><?= __('Add Battle Save Skill') ?></legend>
                <?php
                    echo $this->Form->control('battle_turn_id', ['options' => $battleTurns]);
                    echo $this->Form->control('chat_character_id', ['options' => $chatCharacters]);
                        echo '対戦相手キャラクターID';                    echo $this->Form->control('enemy_chat_character_key');
                        echo '覚醒スキルコード';                    echo $this->Form->control('limit_skill_code');
                        echo 'パッシブスキルコード';                    echo $this->Form->control('passive_skill_code');
                        echo '戦闘スキルコード1';                    echo $this->Form->control('battle_skill1_code');
                        echo '戦闘スキルコード2';                    echo $this->Form->control('battle_skill2_code');
                        echo '戦闘スキルコード3';                    echo $this->Form->control('battle_skill3_code');
                        echo '戦闘スキルコード4';                    echo $this->Form->control('battle_skill4_code');
                        echo '戦闘スキルコード5';                    echo $this->Form->control('battle_skill5_code');
                        echo '戦闘スキルコード6';                    echo $this->Form->control('battle_skill6_code');
                        echo '戦闘スキルコード7';                    echo $this->Form->control('battle_skill7_code');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
