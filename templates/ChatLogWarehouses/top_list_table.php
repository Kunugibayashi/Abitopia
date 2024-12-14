<?php
?>
<table>
    <tbody>
        <?php foreach ($chatLogWarehouses as $key => $chatLogWarehouse) { ?>
        <tr>
            <td class="table-column-date"><?= $chatLogWarehouse->created ?></td>
            <td class="table-column-chat-room-title"><?= h($chatLogWarehouse->chat_room_title) ?></td>
            <td class="table-column-characters"><?= h($chatLogWarehouse->characters) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
