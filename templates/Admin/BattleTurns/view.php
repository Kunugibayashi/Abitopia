<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BattleTurn $battleTurn
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Battle Turn'), ['action' => 'edit', $battleTurn->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Battle Turn'), ['action' => 'delete', $battleTurn->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleTurn->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Battle Turns'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Battle Turn'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleTurns view content">
            <h3><?= h($battleTurn->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($battleTurn->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vs Fukoku Key') ?></th>
                    <td><?= $this->Number->format($battleTurn->vs_fukoku_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vs Before Key') ?></th>
                    <td><?= $this->Number->format($battleTurn->vs_before_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vs After Key') ?></th>
                    <td><?= $this->Number->format($battleTurn->vs_after_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Battle Status') ?></th>
                    <td><?= $this->Number->format($battleTurn->battle_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Battle Turn Count') ?></th>
                    <td><?= $this->Number->format($battleTurn->battle_turn_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Attack Chat Character Key') ?></th>
                    <td><?= $this->Number->format($battleTurn->attack_chat_character_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Defense Chat Character Key') ?></th>
                    <td><?= $this->Number->format($battleTurn->defense_chat_character_key) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($battleTurn->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($battleTurn->created) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Battle Characters') ?></h4>
                <?php if (!empty($battleTurn->battle_characters)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Battle Turn Id') ?></th>
                            <th><?= __('Chat Character Id') ?></th>
                            <th><?= __('Strength') ?></th>
                            <th><?= __('Dexterity') ?></th>
                            <th><?= __('Stamina') ?></th>
                            <th><?= __('Spirit') ?></th>
                            <th><?= __('Hp') ?></th>
                            <th><?= __('Sp') ?></th>
                            <th><?= __('Combo') ?></th>
                            <th><?= __('Continuous Turn Count') ?></th>
                            <th><?= __('Is Limit') ?></th>
                            <th><?= __('Limit Skill Code') ?></th>
                            <th><?= __('Permanent Strength') ?></th>
                            <th><?= __('Temporary Strength') ?></th>
                            <th><?= __('Permanent Hit Rate') ?></th>
                            <th><?= __('Temporary Hit Rate') ?></th>
                            <th><?= __('Permanent Dodge Rate') ?></th>
                            <th><?= __('Temporary Dodge Rate') ?></th>
                            <th><?= __('Defense Skill Code') ?></th>
                            <th><?= __('Defense Skill Attribute') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($battleTurn->battle_characters as $battleCharacter) : ?>
                        <tr>
                            <td><?= h($battleCharacter->id) ?></td>
                            <td><?= h($battleCharacter->battle_turn_id) ?></td>
                            <td><?= h($battleCharacter->chat_character_id) ?></td>
                            <td><?= h($battleCharacter->strength) ?></td>
                            <td><?= h($battleCharacter->dexterity) ?></td>
                            <td><?= h($battleCharacter->stamina) ?></td>
                            <td><?= h($battleCharacter->spirit) ?></td>
                            <td><?= h($battleCharacter->hp) ?></td>
                            <td><?= h($battleCharacter->sp) ?></td>
                            <td><?= h($battleCharacter->combo) ?></td>
                            <td><?= h($battleCharacter->continuous_turn_count) ?></td>
                            <td><?= h($battleCharacter->is_limit) ?></td>
                            <td><?= h($battleCharacter->limit_skill_code) ?></td>
                            <td><?= h($battleCharacter->permanent_strength) ?></td>
                            <td><?= h($battleCharacter->temporary_strength) ?></td>
                            <td><?= h($battleCharacter->permanent_hit_rate) ?></td>
                            <td><?= h($battleCharacter->temporary_hit_rate) ?></td>
                            <td><?= h($battleCharacter->permanent_dodge_rate) ?></td>
                            <td><?= h($battleCharacter->temporary_dodge_rate) ?></td>
                            <td><?= h($battleCharacter->defense_skill_code) ?></td>
                            <td><?= h($battleCharacter->defense_skill_attribute) ?></td>
                            <td><?= h($battleCharacter->modified) ?></td>
                            <td><?= h($battleCharacter->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BattleCharacters', 'action' => 'view', $battleCharacter->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BattleCharacters', 'action' => 'edit', $battleCharacter->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BattleCharacters', 'action' => 'delete', $battleCharacter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleCharacter->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Battle Save Skills') ?></h4>
                <?php if (!empty($battleTurn->battle_save_skills)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Battle Turn Id') ?></th>
                            <th><?= __('Chat Character Id') ?></th>
                            <th><?= __('Enemy Chat Character Key') ?></th>
                            <th><?= __('Limit Skill Code') ?></th>
                            <th><?= __('Passive Skill Code') ?></th>
                            <th><?= __('Battle Skill1 Code') ?></th>
                            <th><?= __('Battle Skill2 Code') ?></th>
                            <th><?= __('Battle Skill3 Code') ?></th>
                            <th><?= __('Battle Skill4 Code') ?></th>
                            <th><?= __('Battle Skill5 Code') ?></th>
                            <th><?= __('Battle Skill6 Code') ?></th>
                            <th><?= __('Battle Skill7 Code') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($battleTurn->battle_save_skills as $battleSaveSkill) : ?>
                        <tr>
                            <td><?= h($battleSaveSkill->id) ?></td>
                            <td><?= h($battleSaveSkill->battle_turn_id) ?></td>
                            <td><?= h($battleSaveSkill->chat_character_id) ?></td>
                            <td><?= h($battleSaveSkill->enemy_chat_character_key) ?></td>
                            <td><?= h($battleSaveSkill->limit_skill_code) ?></td>
                            <td><?= h($battleSaveSkill->passive_skill_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill1_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill2_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill3_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill4_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill5_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill6_code) ?></td>
                            <td><?= h($battleSaveSkill->battle_skill7_code) ?></td>
                            <td><?= h($battleSaveSkill->modified) ?></td>
                            <td><?= h($battleSaveSkill->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'BattleSaveSkills', 'action' => 'view', $battleSaveSkill->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'BattleSaveSkills', 'action' => 'edit', $battleSaveSkill->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'BattleSaveSkills', 'action' => 'delete', $battleSaveSkill->id], ['confirm' => __('Are you sure you want to delete # {0}?', $battleSaveSkill->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>