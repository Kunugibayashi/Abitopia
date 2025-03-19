<?php
?>
<div class="chathistory index content">
    <h3><?= __('履歴') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="table-column-date">更新日</th>
                    <th class="table-column-chat-room-title">ルーム名</th>
                    <th class="table-column-message">メッセージ（200件まで）</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chatLogs as $key => $chatLog) { ?>
                <tr>
                    <td><?= $chatLog->created ?></td>
                    <td><?= $chatLog->chat_room_title ?></td>
                    <td><?= $chatLog->message ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
