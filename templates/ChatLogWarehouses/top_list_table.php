<?php
use Cake\I18n\DateTime;
?>
<table class="index-table">
    <tbody>
        <?php foreach ($chatLogWarehouses as $key => $chatLogWarehouse) { ?>
        <tr>
            <td class="table-column-date"><?= $chatLogWarehouse->created ?></td>
            <td class="table-column-chat-room-title"><?= h($chatLogWarehouse->chat_room_title) ?></td>
            <td class="table-column-action1button"><?= $this->Html->link(__('表示'), ['action' => 'dl', $chatLogWarehouse->id]) ?></td>
            <?php
                $time = DateTime::parse($chatLogWarehouse->created);
                $chatroom = h($chatLogWarehouse->chat_room_title);
                $logfile = $time->format('Ymd_His_') .trim($chatroom) .'.html';
            ?>
            <td class="table-column-action1button"><?= $this->Html->link(__('DL'), ['action' => 'dl', $chatLogWarehouse->id], ['download' => $logfile]) ?></td>
            <td class="table-column-characters"><?= h($chatLogWarehouse->characters) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
