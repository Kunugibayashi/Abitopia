<?php
use Cake\I18n\DateTime;

if (!isset($siteLogfilepath)) {
    $siteLogfilepath = '';
}
?>
<table class="index-table">
    <tbody>
        <?php foreach ($chatLogWarehouses as $key => $chatLogWarehouse) { ?>
        <tr>
            <td class="table-column-date"><?= $chatLogWarehouse->created ?></td>
            <td class="table-column-chat-room-title"><?= h($chatLogWarehouse->chat_room_title) ?></td>
            <?php
                $time = DateTime::parse($chatLogWarehouse->created);
                $chatroom = h($chatLogWarehouse->chat_room_title);
                $logfileName = $time->format('Ymd_His_') .trim($chatroom) .'.html';
                $logfileUrl = $siteLogfilepath .$logfileName;
            ?>
            <?php if (isset($siteLogfileflg) && $siteLogfileflg == 0) { ?>
                <td class="table-column-action1button"><?= $this->Html->link(__('表示'), ['action' => 'dl', $chatLogWarehouse->id]) ?></td>
                <td class="table-column-action1button"><?= $this->Html->link(__('DL'), ['action' => 'dl', $chatLogWarehouse->id], ['download' => $logfileName]) ?></td>
            <?php } else if (isset($siteLogfileflg) && $siteLogfileflg == 1) { ?>
                <?php if(file_exists(ROOT .$logfileUrl)) { ?>
                    <td class="table-column-action1button"><?= $this->Html->link(__('表示'), $logfileUrl) ?></td>
                    <td class="table-column-action1button"><?= $this->Html->link(__('DL'), $logfileUrl, ['download' => $logfileName]) ?></td>
                <?php } else { ?>
                    <td class="table-column-action1button">―</td>
                    <td class="table-column-action1button">―</td>
                <?php } ?>
            <?php } ?>
            <td class="table-column-characters"><?= h($chatLogWarehouse->characters) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
