<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatLogWarehouse[]|\Cake\Collection\CollectionInterface $chatLogWarehouses
 */
?>
<?php
use Cake\I18n\DateTime;
?>
<div class="chatLogWarehouses index content">
    <h3><?= __('ログ倉庫') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th class="table-column-date"><?= $this->Paginator->sort('created', ['label' => '作成日', ]) ?></th>
                    <th class="table-column-chat-room-title"><?= $this->Paginator->sort('chat_room_title', ['label' => 'ルーム名', ]) ?></th>
                    <th class="table-column-action1button"><?= __('表示') ?></th>
                    <th class="table-column-action1button"><?= __('DL') ?></th>
                    <th class="table-column-characters"><?= $this->Paginator->sort('characters', ['label' => '参加者', ]) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chatLogWarehouses as $chatLogWarehouse): ?>
                <tr>
                    <td><?= h($chatLogWarehouse->created) ?></td>
                    <td><?= h($chatLogWarehouse->chat_room_title) ?></td>
                    <td class="table-column-action1button">
                        <?= $this->Html->link(__('表示'), ['action' => 'dl', $chatLogWarehouse->id]) ?>
                    </td>
                    <td class="table-column-action1button">
                        <?php
                            $time = DateTime::parse($chatLogWarehouse->created);
                            $chatroom = h($chatLogWarehouse->chat_room_title);
                            $logfile = $time->format('Ymd_His_') .trim($chatroom) .'.html';
                        ?>
                        <?= $this->Html->link(__('DL'), ['action' => 'dl', $chatLogWarehouse->id], ['download' => $logfile]) ?>
                    </td>
                    <td><?= h($chatLogWarehouse->characters) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('最初へ')) ?>
            <?= $this->Paginator->prev('< ' . __('前へ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
            <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('{{page}}/{{pages}}ページ, {{current}}/{{count}}件')) ?></p>
    </div>
</div>
