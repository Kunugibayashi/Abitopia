<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3>適応ルール一覧</h3>
            <div class="content-description">
                <p>
                    サイト内で適応されているルールを確認します。<br>
                    サイト管理人によって選択可能なため、サイトにより異なります。<br>
                </p>
                <p>
                    戦闘適応ルールでは底力、かすり傷などの特殊ルールのON・OFFが確認可能です。<br>
                    戦闘適応ルールがOFFの場合は適応されていません。<br>
                </p>
                <p>
                    戦闘補正値はスキル使用時の腕力や回避率の補正値の確認が可能です。<br>
                    戦闘補正値が設定されていない場合は、デフォルトの設定が適応されます。<br>
                    システム説明では全ての戦闘補正値がデフォルト値で表示されていますので、ご注意ください。<br>
                </p>
                <p>
                    <?php 
                    $battleRuleFlg = false;
                    foreach ($battleRules as $battleRule):
                        if ($battleRule['active']) {
                            $battleRuleFlg = true;
                            break;
                        }
                    endforeach;
                    $battleCorrectionFlg = false;
                    foreach ($battleCorrections as $battleCorrection):
                        if ($battleCorrection['active']) {
                            $battleCorrectionFlg = true;
                            break;
                        }
                    endforeach;
                    ?>
                    <table class="table-rule">
                        <tbody>
                                <tr>
                                    <td class="table-rule-column-head">戦闘適応ルール</td>
                                    <td class="table-rule-column-onoff"><?php
                                        if ($battleRuleFlg) {
                                            echo '<div class="rule-point-on">変更あり</div>';
                                        } else {
                                            echo '<div class="rule-point-off">変更なし</div>';
                                        }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td class="table-rule-column-head">戦闘補正値</td>
                                    <td class="table-rule-column-onoff"><?php
                                        if ($battleCorrectionFlg) {
                                            echo '<div class="rule-point-on">変更あり</div>';
                                        } else {
                                            echo '<div class="rule-point-off">変更なし</div>';
                                        }
                                    ?></td>
                                </tr>
                        </tbody>
                    </table>
                </p>
            </div>
        </div>
        <div class="content">
            <h3>設定</h3>
            <p>
                ヘッダー右上の設定から可能なことを記載しています。<br>
            </p>
        </div>
        <div class="content">
            <h3>チャットシステム</h3>
            <p>
                チャットシステムの使い方を記載しています。<br>
            </p>
        </div>
        <div class="content">
            <h3>戦闘ステータス</h3>
            <p>
                キャラクターのレベル、ステータスの影響範囲について記載しています。<br>
            </p>
        </div>
        <div class="content">
            <h3>戦闘システム</h3>
            <p>
                戦闘の開始、中断方法から、スキルの説明等を記載しています。<br>
            </p>
        </div>
    </div>
</div>
