<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3 id="level">レベル</h3>
            <div class="content-description">
                <p>
                    ステータス合計値の指標です。<br>
                    レベル3をデフォルトとして戦闘バランスを調節しています。<br>
                    その他のレベルはフレーバーやイベントでの一時的能力低下で使用すると良いでしょう。<br>
                </p>
                <dl>
                    <dt>●レベル0</dt>
                    <dd>
                        <p>
                            すべての能力値が0。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●レベル1</dt>
                    <dd>
                        <p>
                            能力値合計が4。<br>
                            例）1111、2020、0004 など<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●レベル2</dt>
                    <dd>
                        <p>
                            能力値合計が8、(腕力+敏捷) は6以内、(体力+精神) は6以内。<br>
                            例）2222、3302、6200　など<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●レベル3</dt>
                    <dd>
                        <p>
                            能力値合計が12、(腕力+敏捷) は6以内、(体力+精神) は6以内。<br>
                            例）3333、1524、6015 など<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="status">ステータス</h3>
            <div class="content-description">
                <p>
                    ダメージや命中率に関わるステータスです。<br>
                    戦闘バランスを調節しているレベル3は各上限が6ですが、システム上9まで選択することが可能です。<br>
                    9を使用すると戦闘バランスが崩壊しますので、イベントや特別措置をお取りください。<br>
                </p>
                <dl>
                    <dt>●腕力</dt>
                    <dd>
                        <p>
                            ダメージに関係するステータスです。<br>
                            腕力0で基本ダメージ5。1ずつ増やすごとに1加算されます。最大6で基本ダメージ11。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●敏捷</dt>
                    <dd>
                        <p>
                            命中率に関係するステータスです。<br>
                            敏捷0で基本命中率20%。1ずつ増やすごとに10%加算されます。最大6で基本命中率80%。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●体力</dt>
                    <dd>
                        <p>
                            HPに関係するステータスです。<br>
                            体力0で基本HP40。1ずつ増やすごとに4加算されます。最大6でHP64。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●精神</dt>
                    <dd>
                        <p>
                            SPに関係するステータスです。<br>
                            SPとは必殺技に必要なポイントです。MPと考えるとわかりやすいかもしれません。<br>
                            精神0で基本SP4。1ずつ増やすごとに2加算されます。最大6でSP16。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
