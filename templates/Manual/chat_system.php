<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3 id="sanka">チャット参加</h3>
            <div class="content-description">
                <p>
                    キャラクター登録をしていない場合、チャットには参加できません。<br>
                    ヘッダー右上にある「設定」→「登録キャラクター編集」→「キャラクター登録」からキャラクターを登録してください。<br>
                </p>
                <dl>
                    <dt>●入室</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_01.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 50, 'width' => 300,
                                'url' => '/img/manual/chat_01.png',
                            ]
                        ); ?>
                        <p>
                            キャラクターを選択し「入室」ボタンを押下することで通常のチャット画面に遷移します。<br>
                        </p>
                    </dd>
                    <dt>●発言・備考欄</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_02.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 100, 'width' => 300,
                                'url' => '/img/manual/chat_02.png',
                            ]
                        ); ?>
                        <p>
                            発言欄、備考欄に入力し、「発言」ボタン押下またはCtrl+Enterで発言が可能です。<br>
                            備考欄は任意です。服装や外見特徴、お知らせ事項などを記載可能です。発言後、名前にカーソルを当てることでポップアップされます。<br>
                        </p>
                        <p>
                            発言はタグで装飾が可能です。<br>
                            詳細は「<?= $this->Html->link(__('使用可能タグ一覧'), [
                                'controller' => 'Chat', 'action' => 'htmlTagList']) ?>」を確認してください。<br>
                        </p>
                    </dd>
                    <dt>●退出</dt>
                    <dd>
                        <p>
                            「退出」ボタンを押下することでチャットルームから退出します。<br>
                            チャットが終了した場合は必ず退出してください。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="hyouji">表示切替</h3>
            <div class="content-description">
                <p>
                    「表示切替」ボタンを押下すると、発言機能を重視したシンプルなチャット入力画面になります。<br>
                    もう一度押下すると元に戻ります。<br>
                </p>
                <dl>
                    <dt>●通常チャット時</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_03.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 60, 'width' => 300,
                                'url' => '/img/manual/chat_03.png',
                            ]
                        ); ?>
                    </dd>
                    <dt>●戦闘チャット時</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_04.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 150, 'width' => 300,
                                'url' => '/img/manual/chat_04.png',
                            ]
                        ); ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="betsu">別ウィンドウにログを表示</h3>
            <div class="content-description">
                <p>
                    入室後に別ウィンドウにログを出力するボタンが表示されるようになります。<br>
                    選択すると別ウィンドウでログが開き、メインウィンドウと連携して更新されます。<br>
                    フレームの代わりとしてお使いください。<br>
                    ブラウザによっては、ポップアップを許可しないと動作しない可能性があります。<br>
                </p>
                <dl>
                    <dt>●別ウィンドウにログを表示</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_02.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 100, 'width' => 300,
                                'url' => '/img/manual/chat_02.png',
                            ]
                        ); ?>
                        <p>
                            「別ウィンドウでログを表示する」で別ウィンドウにログを表示します。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="daisu">ダイス</h3>
            <div class="content-description">
                <p>
                    TRPGツールのように本格的なものではありませんがチャット中でもダイスをふることができます。<br>
                    ダイス欄に入力して「ダイスを振る」を押下してください。<br>
                </p>
                <dl>
                    <dt>●ダイス</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_05.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 50, 'width' => 300,
                                'url' => '/img/manual/chat_05.png',
                            ]
                        ); ?>
                        <p>
                            例）<br>
                            1d100：100面ダイス1個<br>
                            2d6：6面ダイス2個<br>
                            10d100：100面ダイス10個（最大）<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="omikuji">おみくじ</h3>
            <div class="content-description">
                <p>
                    管理人がおみくじを設定している場合、おみくじを引くことができます。<br>
                    設定されていない場合、表示されません。<br>
                </p>
                <dl>
                    <dt>●おみくじ</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_05.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 50, 'width' => 300,
                                'url' => '/img/manual/chat_05.png',
                            ]
                        ); ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="tefuda">手札</h3>
            <div class="content-description">
                <p>
                    管理人が手札を設定している場合、手札を引くことができます。山札がなくなったらリセットボタンを推して下さい。<br>
                    設定されていない場合、表示されません。<br>
                </p>
                <dl>
                    <dt>●手札</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_05.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 50, 'width' => 300,
                                'url' => '/img/manual/chat_05.png',
                            ]
                        ); ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="settei">自由設定ルーム変更</h3>
            <div class="content-description">
                <p>
                    自由設定ルームは「ルーム名」と「ルーム説明」を変更することができます。<br>
                </p>
                <dl>
                    <dt>●自由設定画面表示</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_06.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 80, 'width' => 300,
                                'url' => '/img/manual/chat_06.png',
                            ]
                        ); ?>
                        <p>
                            「部屋設定変更」を押下すると部屋設定変更画面が表示されます。<br>
                        </p>
                    </dd>
                    <dt>●部屋設定</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/chat_07.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 80, 'width' => 300,
                                'url' => '/img/manual/chat_07.png',
                            ]
                        ); ?>
                        <p>
                            各設定変更して「変更」を押下してください。<br>
                            既に入室者がいる場合は変更できません。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>

        <div class="content">
            <h3 id="log">ログ保存</h3>
            <div class="content-description">
                <p>
                    チャット参加後、ログ倉庫にログが出力され保存が可能です。<br>
                    ログが出力されるタイミングは、チャットルーム内の参加者が全員退出した後となります。<br>
                    チャットルーム用CSSが配置されていた場合は内容が出力されます。背景画像は保存が難しいためログには出力されません。<br>
                </p>
                <dl>
                    <dt>●ログ倉庫</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/log_dl_01.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 50, 'width' => 300,
                                'url' => '/img/manual/log_dl_01.png',
                            ]
                        ); ?>
                        <p>
                            対象ログの「表示」でログの表示、「DL」でログのDLが可能です。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
