<?php
if ($chatRoomCss) {
    $this->Html->css($chatRoomCss .'?date=' .CSS_UPDATE_DATE, ['block' => true]);
}
?>
<div class="row">
    <aside id="id-chat-chatroom-list" class="column-side">
        <ul>
            <?php foreach ($chatRooms as $chatRoom) { ?>
                <li class="chat-chatroom-title">
                    <?php
                    echo $this->Html->link(
                        $chatRoom->title,
                        ['controller' => 'Chat', $chatRoom->id]
                    );
                    ?>
                </li>
            <?php } ?>
        </ul>
    </aside>
    <div class="column-responsive main-container">
    <?php
    // roomid が指定されている場合は入室画面を表示する
    if ($chatRoomId) {
        ?>
        <div class="content">
            <div class="chatroom">
                <h3><?= h($activeChatRooms->title) ?></h3>
                <div class="chatroom-information">
                    <?= nl2br(h($activeChatRooms->information)) ?><br>
                </div>
                <?php if (!$activeChatRooms->readonly) { ?>
                    <div class="chatroom-edit">
                        <a href="<?= $this->Url->build([
                            'controller' => 'ChatRooms',
                            'action' => 'edit',
                            $activeChatRooms->id]) ?>"><?= __('部屋設定変更') ?></a>
                    </div>
                <?php } ?>
            </div>
            <div class="chatentry form">
                <?php echo $this->element('chat_entry_form'); ?>
            </div>
        </div>
        <?php
    } // 入室画面表示
    ?>
    <?php echo $this->element('chat_entries_list'); ?>
    <?php echo $this->element('chat_log'); ?>
    </div>
</div>
