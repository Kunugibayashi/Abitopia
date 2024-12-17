<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatLogWarehouse $chatLogWarehouse
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Chat Log Warehouses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="chatLogWarehouses form content">
            <?= $this->Form->create($chatLogWarehouse) ?>
            <fieldset>
                <legend><?= __('Add Chat Log Warehouse') ?></legend>
                <?php
                        echo 'エントリーキー';                    echo $this->Form->control('entry_key');
                        echo 'チャットルームタイトル';                    echo $this->Form->control('chat_room_title');
                        echo '参加者';                    echo $this->Form->control('characters');
                        echo 'ログ文字列';                    echo $this->Form->control('logs');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
