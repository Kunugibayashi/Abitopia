<?php
?>
<table>
    <tbody>
        <?php foreach ($chatRooms as $key => $chatRoom) { ?>
        <tr>
            <td class="table-column-chat-room-title"><?php echo $this->Html->link($chatRoom['title'], [
                'controller' => 'Chat', 'action' => 'index', $chatRoom['id']]);
                ?>
            </td>
            <td class="table-column-chat-entries">
                <?php if(!isset($chatRoom['chat_entries'])) cotinue; ?>
                <?php foreach ($chatRoom['chat_entries'] as $key => $chatEntry) { ?>
                    <div class="chatroomlist-name"
                        style="<?php echo $this->Html->style([
                                'color' => $chatEntry['color'],
                                'background-color' => $chatEntry['backgroundcolor'],
                    ]); ?>"><?php echo h($chatEntry['fullname']); ?></div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
