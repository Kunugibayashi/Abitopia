<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatRoom $chatRoom
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chatRoom->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chatRoom->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Chat Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="chatRooms form content">
            <?= $this->Form->create($chatRoom) ?>
            <fieldset>
                <legend><?= __('Edit Chat Room') ?></legend>
                <?php
                    echo 'チャットルームタイトル';
                    echo $this->Form->control('title');
                    echo 'チャットルーム説明';
                    echo $this->Form->control('information');
                    echo '公開するか？（0:非公開 1:公開）';
                    echo $this->Form->control('published');
                    echo '管理人のみルーム説明編集可能か？（0:ユーザーも可能な自由設定ルーム 1:管理人のみ可能）';
                    echo $this->Form->control('readonly');
                    echo '表示順序';
                    echo $this->Form->control('displayno');
                    echo 'おみくじ1を表示するか？（0:非表示 1:表示）';
                    echo $this->Form->control('omikuji1flg');
                    echo 'おみくじ1タイトル';
                    echo $this->Form->control('omikuji1name');
                    echo 'おみくじ1内容（複数の場合は,区切り）';
                    echo $this->Form->control('omikuji1text');
                    echo 'おみくじ2を表示するか？（0:非表示 1:表示）';
                    echo $this->Form->control('omikuji2flg');
                    echo 'おみくじ2タイトル';
                    echo $this->Form->control('omikuji2name');
                    echo 'おみくじ2内容（複数の場合は,区切り）';
                    echo $this->Form->control('omikuji2text');
                    echo '手札1を表示するか？';
                    echo $this->Form->control('deck1flg');
                    echo '手札1タイトル';
                    echo $this->Form->control('deck1name');
                    echo '手札1内容（複数の場合は,区切り。初期処理後は頭に#が付与。0#が山札内、1#がひかれたカード。文章内に#がある場合意図しない挙動になる可能性あり）';
                    echo $this->Form->control('deck1text');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
