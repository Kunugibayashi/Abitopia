<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatLogWarehouse[]|\Cake\Collection\CollectionInterface $chatLogWarehouses
 */
?>
<?php
use Cake\I18n\DateTime;

if (!isset($siteLogfilepath)) {
    $siteLogfilepath = '';
}
?>
<div class="chatLogWarehouses index content">
    <div class="button-container">
        <h3><?= __('ログ倉庫') ?></h3>
        <div class="button-group-wrap">
            <?= $this->Html->link(__('ローカル用IndexファイルDL'), ['action' => 'dlLocalIndex'], ['download' => 'index.html', 'class' => 'link-pseudo-button']); ?>
            <?= $this->Html->link(__('一括DL'), ['action' => 'dlAllData'], ['class' => 'link-pseudo-button']); ?>
        </div>
    </div>
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
                    <?php if (isset($siteLogfileflg) && $siteLogfileflg == 0) { ?>
                        <td><?= $this->Html->link(__('表示'), ['action' => 'dl', $chatLogWarehouse->id]) ?></td>
                        <td><?= $this->Html->link(__('DL'), ['action' => 'dl', $chatLogWarehouse->id], ['download' => $logfileName]) ?></td>
                    <?php } else if (isset($siteLogfileflg) && $siteLogfileflg == 1) { ?>
                        <?php if(file_exists(ROOT .$logfileUrl)) { ?>
                            <td><?= $this->Html->link(__('表示'), $logfileUrl) ?></td>
                            <td><?= $this->Html->link(__('DL'), $logfileUrl, ['download' => $logfileName]) ?></td>
                        <?php } else { ?>
                            <td>―</td>
                            <td>―</td>
                        <?php } ?>
                    <?php } ?>
                    <td class="table-column-characters"><?= h($chatLogWarehouse->characters) ?></td>
                </tr>
                <?php } ?>
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

