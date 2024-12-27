<?php
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= h($message->title) ?></title>
    </head>
    <style>
        body {
            background: #f5f7fa;
            color: #606c76;
            letter-spacing: .01em;
            line-height: 1.6;
        }
        main {
            display: block;
        }
        div {
            word-break: break-all;
        }
        table {
            text-align: left;
            width: 100%;
        }
        table, th, td {
            word-break: break-all;
        }
        table tbody tr th,
        table tbody tr td {
            width: auto;
            border-bottom: 0.1rem solid #e1e1e1;
            padding: 1.2rem 1.5rem;
            text-align: left;
        }
        .text-wrap strong {
            display: block;
            padding: 1.2rem 1.5rem 0 1.5rem;
        }
        .message-wrap {
            display: block;
            padding: 0 1.5rem 0 1.5rem;
        }
        .container,
        .main-container {
            display: flex;
            justify-content: space-evenly;
            width: 90vW;
            max-width: 90vW;
            padding: 0 2rem;
            margin: 0 auto 2rem;
            margin-bottom: 2rem;
        }
        .content {
            padding: 2rem;
            background: #ffffff;
            border-radius: 0.4rem;
            box-shadow: 0 7px 14px 0 rgba(60, 66, 87, 0.1), 0 3px 6px 0 rgba(0, 0, 0, 0.07);
            margin-bottom: 2rem;
        }
        .table-column-head {
            width: 15rem;
            max-width: 15rem;
        }
    </style>
    <body>
        <main class="main">
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
        </main>
    </body>
</html>
