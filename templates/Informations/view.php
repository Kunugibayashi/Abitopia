<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Information $information
 */
?>
<div class="row">
    <aside class="column-side">
        <div class="side-nav">
            <h4 class="heading"><?= __('メニュー') ?></h4>
            <?= $this->Html->link(__('お知らせ一覧'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive main-container">
        <div class="informations view content">
            <h3><?= h($information->title) ?></h3>
            <table>
                <tr>
                    <th class="table-column-head"><?= __('件名') ?></th>
                    <td><?= h($information->title) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('作成日') ?></th>
                    <td><?= h($information->created) ?></td>
                </tr>
            </table>
            <div class="text-wrap">
                <strong><?= __('詳細') ?></strong>
                <p class="detail-wrap">
                    <?php echo nl2br(h($information->detail)); ?>
                </p>
            </div>
        </div>
    </div>
</div>
