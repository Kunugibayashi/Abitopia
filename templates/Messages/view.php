<?php
?>
<div class="row">
    <aside class="column-side">
        <div class="side-nav">
            <h4 class="heading"><?= __('メニュー') ?></h4>
            <?= $this->Html->link(__('メッセージ一覧'), ['controller' => 'Messages', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php if ($message->from_chat_character_fullname) { ?>
                <?= $this->Html->link(__('返信'), [
                        'controller' => 'Messages',
                        'action' => 'send',
                        $message->from_chat_character_key,
                    ], ['class' => 'side-nav-item']) ?>
            <?php } ?>
        </div>
    </aside>
    <div class="column-responsive main-container">
        <div class="sendMessages view content">
            <h3><?= h($message->title) ?></h3>
            <table>
                <?php if ($message->to_chat_character_fullname) { ?>
                    <tr>
                        <th class="table-column-head"><?= __('受信日') ?></th>
                        <td><?= h($message->created) ?></td>
                    </tr>
                    <tr>
                        <th class="table-column-head"><?= __('宛先') ?></th>
                        <td><?= h($message->to_chat_character_fullname) ?></td>
                    </tr>
                    <tr>
                        <th class="table-column-head"><?= __('差出人') ?></th>
                        <td><?= h($message->chat_character_fullname) ?></td>
                    </tr>
                <?php } ?>
                <?php if ($message->from_chat_character_fullname) { ?>
                    <tr>
                        <th class="table-column-head"><?= __('送信日') ?></th>
                        <td><?= h($message->created) ?></td>
                    </tr>
                    <tr>
                        <th class="table-column-head"><?= __('宛先') ?></th>
                        <td><?= h($message->chat_character_fullname) ?></td>
                    </tr>
                    <tr>
                        <th class="table-column-head"><?= __('差出人') ?></th>
                        <td><?= h($message->from_chat_character_fullname) ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th class="table-column-head"><?= __('件名') ?></th>
                    <td><?= h($message->title) ?></td>
                </tr>
            </table>
            <div class="text-wrap">
                <strong><?= __('本文') ?></strong>
                <p class="message-wrap">
                    <?php echo nl2br(h($message->message)); ?>
                </p>
            </div>
        </div>
    </div>
</div>
