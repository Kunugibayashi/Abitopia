<?php
/*
 * 個別呼び出しの際、独立して動かせるようにするため、スタイルを記載する
 */
?>
<?php
if (isset($chatRoomCss)) {
    $this->Html->css($chatRoomCss .'?date=' .CSS_UPDATE_DATE, ['block' => true]);
}
?>
<?= $this->fetch('css') ?>

<div id="id-chat-log-content">
<style>
html { box-sizing: border-box; font-size: 62.5%; }
body { color: #606c76; font-size: 1.6em; font-weight: 300; letter-spacing: .01em; line-height: 1.6; }
<?php if ($chatRoom->design == 1) { ?>
    .chat-log-contenar { margin: 1rem; }
    .chat-log { border-radius: 0rem; overflow: hidden; padding: 0rem; line-height: 1.4; }
    .chat-log-date-line { display: inline-block; text-align: right; font-size: 0.8rem; opacity: 0.5; }
<?php } else { ?>
    .chat-log-contenar { margin: 1rem; }
    .chat-log { border-radius: 0.5rem; overflow: hidden; padding: 1rem;}
    .chat-log-date-line { display: block; text-align: right; font-size: 0.8rem; opacity: 0.5; }
<?php } ?>
.chat-log-title { border-bottom: inset 1px; padding: 1rem 0;}
.chat-log-title:hover + .chat-log-information { display: inline-block; }
.chat-log-information { display: none; position: absolute; color: #000000; background-color: #f5f7fa; padding: 0.5rem; margin: 0; z-index: 10; }
.chat-log-fullname:hover + .chat-log-note { display: inline-block; }
.chat-log-note { display: none; position: absolute; color: #000000; background-color: #f5f7fa; padding: 0.5rem; margin: 0; z-index: 10; }
.battle-log-status { display: block; text-align: right; font-size: 1rem; opacity: 0.5; }
.battle-log-narration { display: block; }
.battle-log-narration:hover + .battle-log-memo { display: inline-block; }
.battle-log-memo { display: none; position: absolute; color: #000000; background-color: #f5f7fa; padding: 0.5rem; margin: 0; z-index: 10; }
.system { padding: 0 1.4rem; font-size: 1.4rem; }
.chat-log-title, .chat-log-information, .chat-log-contenar, .chat-log, .chat-log-message, .chat-log-fullname, .chat-log-note, .chat-log-date, .system, .battle-log-narration, .battle-log-memo { word-break: break-all; }
.bold { font-weight: bold; }
.oblique { font-style: oblique; }
.line-through { text-decoration: line-through; }
.font50 { font-size: 50%; } .font150 { font-size: 150%; } .font200 { font-size: 200%; }
<?php foreach ($colorCodes as $value) { ?><?php echo "." .$value['name'] ?> { color: <?= $value['code'] ?>; } <?php } ?>

<?php
// 上記改行用空白
if (isset($chatRoomCssString)) {
    echo $chatRoomCssString;
}
// 下記改行用空白
?>

</style>
<?php
if (isset($isChatLogWindow) && $isChatLogWindow) {
?>
    <?= $this->Html->script('jquery-3.7.1.min.js') ?>
    <script>
    // ブラウザによっては初回描画時にも beforeunload が動く
    // そのため、load も設定する
    jQuery(window).on('beforeunload', function() {
        jQuery.ajax({
            url: '<?php echo $this->Url->build([
                        'controller' => 'Chat',
                        'action' => 'chatLogWindow',
                        $chatRoomId,
                        0
                    ]); ?>',
            type: 'get',
        }).done(function (data, status, jqXHR) {
        });
        window.opener.jQuery('#id-open-log-window-value').val(0);
    });
    // load を設定しないと 0 で上書きされてしまう
    jQuery(window).on('load', function() {
        jQuery.ajax({
            url: '<?php echo $this->Url->build([
                        'controller' => 'Chat',
                        'action' => 'chatLogWindow',
                        $chatRoomId,
                        1
                    ]); ?>',
            type: 'get',
        }).done(function (data, status, jqXHR) {
        });
        window.opener.jQuery('#id-open-log-window-value').val(1);
    });
    </script>
<?php
}
?>
<?php
if (!$chatLog) {
    ?>
    <div class="chat-log-title">
        <?php echo __('ログが存在しません。'); ?>
    </div>
    <?php
    return;
}
?>
<h3 class="chat-log-title"><?php echo h($chatLog->chat_room_title); ?></h3>
<div class="chat-log-information"><?php echo h($chatLog->chat_room_information); ?></div>
<?php
foreach ($chatLogs as $chatLog) {
    $isSystem = ($chatLog->chat_character_key) ? '' : 'system';
    ?>
    <div class="chat-log-contenar">
        <p class="chat-log <?= $isSystem ?>"
            <?php if ($chatRoom->design == 1) { ?>
                style="<?php echo $this->Html->style([ 'color' => $chatLog->color, 'background-color' => 'unset',]); ?>"
            <?php } else { ?>
                style="<?php echo $this->Html->style([ 'color' => $chatLog->color, 'background-color' => $chatLog->backgroundcolor,]); ?>"
            <?php } ?>
        >
            <?php if (!$isSystem) { ?>
                <span class="chat-log-fullname"><?php echo h($chatLog->fullname); ?></span>
                <span class="chat-log-note">note: <?php echo h($chatLog->note); ?></span>
                <span class="chat-log-delimiter">≫</span>
            <?php } ?>
            <span class="chat-log-message"><?php echo $this->Htmltag->adapt(nl2br(h($chatLog->message))); ?></span>
            <span class="chat-log-date-line">
                <?php if ($chatLog->modified != $chatLog->created) { ?>
                    <span class="chat-log-isedit">（編集済み）</span>
                <?php } ?>
                <span class="chat-log-date">
                    <?php echo h($chatLog->created); ?>
                </span>
            </span>
            <?php if ($chatLog->battle_log && $chatLog->battle_log->status) { ?>
                <span class="battle-log-status"><?php echo nl2br($chatLog->battle_log->status); ?></span>
            <?php } ?>
        </p>
        <?php if ($chatLog->battle_log) { ?>
        <p class="system">
            <?php if ($chatLog->battle_log->narration) { ?>
                <span class="battle-log-narration"><?php echo nl2br(h($chatLog->battle_log->narration)); ?></span>
            <?php } ?>
            <?php if ($chatLog->battle_log->memo) { ?>
                <span class="battle-log-memo"><?php echo nl2br($chatLog->battle_log->memo); ?></span>
            <?php } ?>
        </p>
        <?php } ?>
    </div>
    <?php } ?>
</div>
