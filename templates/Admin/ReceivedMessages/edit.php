<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReceivedMessage $receivedMessage
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $receivedMessage->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $receivedMessage->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Received Messages'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="receivedMessages form content">
            <?= $this->Form->create($receivedMessage) ?>
            <fieldset>
                <legend><?= __('Edit Received Message') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                        echo '宛先チャットキャラクターID';                    echo $this->Form->control('chat_character_key');
                        echo '宛先キャラクター名';                    echo $this->Form->control('chat_character_fullname');
                        echo '差出人チャットキャラクターID';                    echo $this->Form->control('from_chat_character_key');
                        echo '差出人キャラクター名';                    echo $this->Form->control('from_chat_character_fullname');
                        echo '私書タイトル';                    echo $this->Form->control('title');
                        echo '私書メッセージ';                    echo $this->Form->control('message');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
