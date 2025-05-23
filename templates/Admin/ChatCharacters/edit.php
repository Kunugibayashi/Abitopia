<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatCharacter $chatCharacter
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chatCharacter->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chatCharacter->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Chat Characters'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="chatCharacters form content">
            <?= $this->Form->create($chatCharacter) ?>
            <fieldset>
                <legend><?= __('Edit Chat Character') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo 'キャラクター名';
                    echo $this->Form->control('fullname');
                    echo '性別';
                    echo $this->Form->control('sex');
                    echo 'メッセージ文字色';
                    echo $this->Form->control('color');
                    echo 'メッセージ背景色';
                    echo $this->Form->control('backgroundcolor');
                    echo '二つ名';
                    echo $this->Form->control('nickname');
                    echo '所属';
                    echo $this->Form->control('team');
                    echo 'タグ';
                    echo $this->Form->control('tag');
                    echo 'URL';
                    echo $this->Form->control('url');
                    echo 'フリー欄';
                    echo $this->Form->control('free1');
                    echo '詳細';
                    echo $this->Form->control('detail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
