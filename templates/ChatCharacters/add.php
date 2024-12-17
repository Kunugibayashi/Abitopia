<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ChatCharacter $chatCharacter
 */
?>
<div class="row">
    <aside class="column-side">
        <div class="side-nav">
            <h4 class="heading"><?= __('メニュー') ?></h4>
            <?= $this->Html->link(__('名簿'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive main-container">
        <div class="chatCharacters form content">
            <?= $this->Form->create($chatCharacter) ?>
            <fieldset>
                <legend><?= __('キャラクター追加') ?></legend>
                <?php echo $this->Form->hidden('user_id'); ?>
                <?php echo $this->Form->control('fullname', ['label' => '名前', ]); ?>
                <div class="content-nickname-wrap">
                    <?php echo $this->Form->control('nickname', ['label' => '二つ名', ]); ?>
                </div>
                <?php echo $this->Form->control('sex', ['label' => '性別', ]); ?>
                <div class="content-team-wrap">
                    <?php echo $this->Form->control('team', ['label' => '所属', ]); ?>
                </div>
                <?php echo $this->element('colorpreview'); ?>
                <div class="content-tag-wrap">
                    <?php echo $this->Form->control('tag', ['label' => 'タグ', ]); ?>
                </div>
                <?php echo $this->Form->control('url', ['label' => 'URL', ]); ?>
                <?php echo $this->element('battle_status_form_control'); ?>
                <div class="content-free1-wrap">
                    <?php
                        echo $this->Form->control('free1', [
                            'label' => 'フリー欄',
                            'maxlength' => '10000',
                        ]);
                    ?>
                </div>
                <?php
                    echo $this->Form->control('detail', [
                        'label' => '詳細',
                        'maxlength' => '10000',
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('登録')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
