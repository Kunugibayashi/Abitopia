<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\BattleRuleConfig> $battleRuleConfigs
 */
?>
<div class="column">
    <div class="battleRuleConfigs form content">
    <h3><?= __('戦闘補正値カスタム画面') ?></h3>
        <p>
            管理者が戦闘時のスキル補正値を変更することができます。<br>
            有効化にチェックをいれないと、補正値を入れていても適応されませんのでご注意ください。<br>
            有効化にチェックを入れない場合は、デフォルトの設定が反映されます。<br>
        </p>
        <?= $this->Form->create() ?>
        <fieldset>
        <table>
            <tr>
                <th>対応する技能名</th>
                <th>デフォルト適応式</th>
                <th>現在の適応式</th>
                <th>入力補正値</th>
                <th>入力補正値を有効化するか？</th>
            </tr>
            <?php foreach ($battleCorrections as  $configCode => $battleCorrection): ?>
                <tr>
                    <th><?= h($battleCorrection['information']) ?></th>
                    <th><?php
                        $format = $battleCorrection['formula'];
                        $formula = __($format, [
                            $battleCorrection['default'],
                        ]);
                        ?><?= h($formula) ?>
                    </th>
                    <td><?php
                        $format = $battleCorrection['formula'];
                        $value = $battleCorrection['default'];
                        if ($battleCorrection['active']) {
                            $value = $battleCorrection['value'];
                        }
                        $formula = __($format, [
                            $value,
                        ]);
                        ?><?= h($formula) ?>
                    </td>
                    <td><?php
                            $inputName = 'values[' .$battleCorrection['code']. ']';
                            echo $this->Form->control($inputName, [
                                'label' => '',
                                'name' => $inputName,
                                'value' => $battleCorrection['value'],
                            ]);
                        ?>
                    </td>
                    <td><?php
                        $inputName = 'actives[' .$battleCorrection['code']. ']';
                        echo $this->Form->control($inputName, [
                            'label' => '有効化',
                            'type' => 'checkbox',
                            'name' => $inputName,
                            'value' => '1',
                            'checked' => $battleCorrection['active'],
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