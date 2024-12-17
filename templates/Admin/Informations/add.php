<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Information $information
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Informations'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="informations form content">
            <?= $this->Form->create($information) ?>
            <fieldset>
                <legend><?= __('Add Information') ?></legend>
                <?php
                        echo 'お知らせタイトル';                    echo $this->Form->control('title');
                        echo 'お知らせメッセージ';                    echo $this->Form->control('detail');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
