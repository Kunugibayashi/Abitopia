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
            <?= $this->Html->link(__('名簿一覧'), ['action' => 'search'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('登録キャラクター編集'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?php if (isset($siteLetterflg) && $siteLetterflg == 1) { ?>
                <?= $this->Html->link(__('私書送信'), [
                        'controller' => 'Messages',
                        'action' => 'send',
                        $chatCharacter->id,
                    ], ['class' => 'side-nav-item']) ?>
            <?php } ?>
        </div>
    </aside>
    <div class="column-responsive main-container">
        <div class="chatCharacters view content">
            <h3><?= h($chatCharacter->fullname) ?></h3>
            <table>
                <tr>
                    <th class="table-column-head"><?= __('名前') ?></th>
                    <td><?= h($chatCharacter->fullname) ?></td>
                </tr>
                <tr class="content-nickname-wrap">
                    <th class="table-column-head""><?= __('二つ名') ?></th>
                    <td><?= h($chatCharacter->nickname) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('性別') ?></th>
                    <td><?= h($chatCharacter->sex) ?></td>
                </tr>
                <tr class="content-team-wrap">
                    <th class="table-column-head""><?= __('所属') ?></th>
                    <td><?= h($chatCharacter->team) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('色') ?></th>
                    <td><span style="color:<?= $chatCharacter->color ?>"><?= h($chatCharacter->color) ?></span></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('背景色') ?></th>
                    <td><span style="color:<?= $chatCharacter->backgroundcolor ?>"><?= h($chatCharacter->backgroundcolor) ?></span></td>
                </tr>
                <tr class="content-team-wrap">
                    <th class="table-column-head"><?= __('タグ') ?></th>
                    <td><?= h($chatCharacter->tag) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('URL') ?></th>
                    <td>
                        <?php
                        if (isset($chatCharacter->url) && !empty($chatCharacter->url)) {
                            echo $this->Html->link('■', h($chatCharacter->url), ['target' => '_blank']);
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('レベル') ?></th>
                    <td><?= h($chatCharacter->battle_character_status->level) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('腕力') ?></th>
                    <td><?= h($chatCharacter->battle_character_status->strength) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('敏捷') ?></th>
                    <td><?= h($chatCharacter->battle_character_status->dexterity) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('体力') ?></th>
                    <td><?= h($chatCharacter->battle_character_status->stamina) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('精神') ?></th>
                    <td><?= h($chatCharacter->battle_character_status->spirit) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('更新日') ?></th>
                    <td><?= h($chatCharacter->modified) ?></td>
                </tr>
                <tr>
                    <th class="table-column-head"><?= __('作成日') ?></th>
                    <td><?= h($chatCharacter->created) ?></td>
                </tr>
            </table>
            <div class="text-wrap content-free1-wrap">
                <strong><?= __('フリー欄') ?></strong>
                <p class="detail-wrap">
                    <?php echo nl2br(h($chatCharacter->free1)); ?>
                </p>
            </div>
            <div class="text-wrap">
                <strong><?= __('詳細') ?></strong>
                <p class="detail-wrap">
                    <?php echo nl2br(h($chatCharacter->detail)); ?>
                </p>
            </div>
        </div>
    </div>
</div>
