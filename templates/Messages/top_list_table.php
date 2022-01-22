<?php
 ?>
 <table>
    <tbody>
        <?php if (isset($receivedMessages) && $receivedMessages) { ?>
            <?php foreach ($receivedMessages as $key => $receivedMessage) { ?>
                <tr>
                    <td class="table-column-date"><?= $receivedMessage->created ?></td>
                    <td><?= $receivedMessage->chat_character_fullname ?></td>
                    <td><?= $receivedMessage->from_chat_character_fullname ?></td>
                    <td><?= $receivedMessage->title ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
 </table>
