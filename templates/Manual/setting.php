<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3 id="paswa">パスワード変更</h3>
            <p>
                新パスワードに変更が可能です。<br>
                パスワードは再発行できませんので忘れないようにお願いいたします。<br>
                また左メニューからアカウントの削除も可能です。<br>
            </p>
        </div>
        <div class="content">
            <h3 id="touroku">登録キャラクター編集</h3>
            <p>
                キャラクターの登録、削除、編集が可能です。<br>
                チャット中も変更でき、変更内容は名簿やチャット情報に即時反映されます。<br>
            </p>
        </div>
        <div class="content">
            <h3 id="hatsugen">発言編集</h3>
            <p>
                チャット中の発言を編集することができます。<br>
                入室中にのみ編集可能です。ログ倉庫に格納されたログは編集できません。<br>
            </p>
        </div>
        <div class="content">
            <h3 id="midoku">未読私書お知らせ</h3>
            <p>
                私書を受信し、その私書を確認していない場合、メール型のアイコンが表示されます。<br>
                アイコンから私書一覧に遷移することが可能です。<br>
            </p>
            <?php echo $this->Html->image('manual/message_01.png',
                [
                    'height' => 100, 'width' => 200,
                    'url' => '/img/manual/message_01.png',
                ]
            ); ?>
        </div>
    </div>
</div>
