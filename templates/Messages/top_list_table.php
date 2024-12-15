<?php
?>
<table class="index-table">
    <tbody>
        <?php if (isset($receivedMessages) && $receivedMessages) { ?>
            <?php foreach ($receivedMessages as $key => $receivedMessage) { ?>
                <tr>
                    <td class="table-column-date"><?= $receivedMessage->created ?></td>
                    <td class="table-column-fullname"><?= $receivedMessage->chat_character_fullname ?></td>
                    <td class="table-column-fullname"><?= $receivedMessage->from_chat_character_fullname ?></td>
                    <td class="table-column-message-title"><?= $receivedMessage->title ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
