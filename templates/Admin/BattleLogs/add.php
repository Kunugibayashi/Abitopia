<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BattleLog $battleLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Battle Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="battleLogs form content">
            <?= $this->Form->create($battleLog) ?>
            <fieldset>
                <legend><?= __('Add Battle Log') ?></legend>
                <?php
                        echo 'チャットログID';                    echo $this->Form->control('chat_log_id');
                        echo 'ステータス';                    echo $this->Form->control('status');
                        echo 'ナレーション';                    echo $this->Form->control('narration');
                        echo '判定結果メモ';                    echo $this->Form->control('memo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
