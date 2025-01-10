<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\BattleRuleConfig> $battleRuleConfigs
 */
?>
<div class="column">
    <div class="battleRuleConfigs form content">
    <h3><?= __('戦闘ルール設定カスタム画面') ?></h3>
        <?= $this->Form->create() ?>
        <fieldset>
        <table>
            <?php foreach ($battleRules as $battleRule): ?>
                <tr>
                    <th><?= h($battleRule['information']) ?></th>
                    <td><?php
                        $inputName = 'actives[' .$battleRule['code']. ']';
                        echo $this->Form->control($inputName, [
                            'label' => '有効化',
                            'type' => 'checkbox',
                            'name' => $inputName,
                            'value' => '1',
                            'checked' => $battleRule['active'],
                        ]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        </fieldset>
        <?= $this->Form->button(__('設定')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>