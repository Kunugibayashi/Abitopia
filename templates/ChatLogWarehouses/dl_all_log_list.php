<?php
use Cake\I18n\DateTime;

if (!isset($siteLogfilepath)) {
    $siteLogfilepath = '';
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>DLログ一覧</title>
    </head>
    <style>
        body {
            background: #f5f7fa;
            color: #606c76;
            letter-spacing: .01em;
            line-height: 1.6;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
            word-break: break-all;
            display: block;
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
            padding: 0.5em 1rem;
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
        .table-column-date {
            width: 10rem;
            min-width: 10rem;
        }
        .table-column-chat-room-title {
            width: 28rem;
            min-width: 28rem;
        }
        .table-column-action1button {
            width: 4rem;
            min-width: 4rem;
        }
        .table-column-characters {
            word-break: normal;
        }
    </style>
    <body>
        <main class="main">
            <div class="column-responsive main-container">
                <h3>DLログ一覧</h3>
                <table>
                    <tbody>
                        <?php foreach ($chatLogWarehouses as $chatLogWarehouse) { ?>
                        <tr>
                            <td class="table-column-date"><?= $chatLogWarehouse->created ?></td>
                            <td class="table-column-chat-room-title"><?= h($chatLogWarehouse->chat_room_title) ?></td>
                            <?php
                                $time = DateTime::parse($chatLogWarehouse->created);
                                $chatroom = h($chatLogWarehouse->chat_room_title);
                                $logfileName = $time->format('Ymd_His_') .trim($chatroom) .'.html';
                                $logfileUrl = $siteLogfilepath .$logfileName;
                            ?>
                            <?php if(file_exists(ROOT .$logfileUrl)) { ?>
                                <td class="table-column-action1button"><a href="<?= h('./' .$logfileName) ?>">表示</a></td>
                            <?php } else { ?>
                                <td class="table-column-action1button">―</td>
                            <?php } ?>
                            <td class="table-column-characters"><?= h($chatLogWarehouse->characters) ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
</html>
