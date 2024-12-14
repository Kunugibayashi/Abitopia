<table>
    <tbody>
        <?php foreach ($chatLogs as $key => $chatLog) { ?>
        <tr>
            <td class="table-column-date"><?= $chatLog->created ?></td>
            <td class="table-column-chat-room-title"><?= $chatLog->chat_room_title ?></td>
            <td class="table-column-message"><?= $chatLog->message ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
