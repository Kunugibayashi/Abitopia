<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3 id="batorururu">戦闘適応ルール</h3>
            <table class="table-rule">
                <tbody>
                    <?php foreach ($battleRules as $battleRule): ?>
                        <tr>
                            <td class="table-rule-column-head"><?= h($battleRule['information']) ?></td>
                            <td class="table-rule-column-onoff"><?php
                                if ($battleRule['active']) {
                                    echo '<div class="rule-point-on">ON</div>';
                                } else {
                                    echo '<div class="rule-point-off">OFF</div>';
                                }
                            ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="content">
            <h3 id="hosei">戦闘補正値</h3>
            <table class="table-rule">
                <tbody>
                    <tr>
                        <th class="table-rule-column-skill-name">対応スキル名</th>
                        <th class="table-rule-column-formula">デフォルト適応式</th>
                        <th class="table-rule-column-arrow"><!-- ⇒ --></th>
                        <th class="table-rule-column-formula2">現在の適応式</th>
                        <th class="table-rule-column-onoff"><!-- onoff --></th>
                    </tr>
                    <?php foreach ($battleCorrections as  $configCode => $battleCorrection): ?>
                        <tr>
                            <td><?= h($battleCorrection['information']) ?></td>
                            <td><?php
                                $format = $battleCorrection['formula'];
                                $formula = __($format, [
                                    $battleCorrection['default'],
                                ]);
                                ?><?= h($formula) ?>
                            </td>
                            <?php if ($battleCorrection['active']) { ?>
                                <td>⇒</td>
                                <td><?php
                                    $format = $battleCorrection['formula'];
                                    $formula = __($format, [
                                        $battleCorrection['value'],
                                    ]);
                                    ?><?= h($formula) ?>
                                </td>
                                <td class="table-rule-column-onoff">
                                    <div class="rule-point-on">変更あり</div>
                                </td>
                            <?php } else { ?>
                                <td><!-- 表示なし --></td>
                                <td><!-- 表示なし --></td>
                                <td class="table-rule-column-onoff">
                                    <div class="rule-point-off">デフォルト</div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
