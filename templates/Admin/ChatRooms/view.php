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
            <?= $this->Html->link(__('Edit Chat Room'), ['action' => 'edit', $chatRoom->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Chat Room'), ['action' => 'delete', $chatRoom->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chatRoom->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Chat Rooms'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Chat Room'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="chatRooms view content">
            <h3><?= h($chatRoom->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($chatRoom->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Omikuji1name') ?></th>
                    <td><?= h($chatRoom->omikuji1name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Omikuji2name') ?></th>
                    <td><?= h($chatRoom->omikuji2name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deck1name') ?></th>
                    <td><?= h($chatRoom->deck1name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($chatRoom->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Design') ?></th>
                    <td><?= $this->Number->format($chatRoom->design) ?></td>
                </tr>
                <tr>
                    <th><?= __('Published') ?></th>
                    <td><?= $this->Number->format($chatRoom->published) ?></td>
                </tr>
                <tr>
                    <th><?= __('Readonly') ?></th>
                    <td><?= $this->Number->format($chatRoom->readonly) ?></td>
                </tr>
                <tr>
                    <th><?= __('Displayno') ?></th>
                    <td><?= $this->Number->format($chatRoom->displayno) ?></td>
                </tr>
                <tr>
                    <th><?= __('Omikuji1flg') ?></th>
                    <td><?= $this->Number->format($chatRoom->omikuji1flg) ?></td>
                </tr>
                <tr>
                    <th><?= __('Omikuji2flg') ?></th>
                    <td><?= $this->Number->format($chatRoom->omikuji2flg) ?></td>
                </tr>
                <tr>
                    <th><?= __('Deck1flg') ?></th>
                    <td><?= $this->Number->format($chatRoom->deck1flg) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($chatRoom->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($chatRoom->created) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Information') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chatRoom->information)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Omikuji1text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chatRoom->omikuji1text)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Omikuji2text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chatRoom->omikuji2text)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Deck1text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($chatRoom->deck1text)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Chat Entries') ?></h4>
                <?php if (!empty($chatRoom->chat_entries)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Chat Room Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Chat Character Id') ?></th>
                            <th><?= __('Entry Key') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($chatRoom->chat_entries as $chatEntry) : ?>
                        <tr>
                            <td><?= h($chatEntry->id) ?></td>
                            <td><?= h($chatEntry->chat_room_id) ?></td>
                            <td><?= h($chatEntry->user_id) ?></td>
                            <td><?= h($chatEntry->chat_character_id) ?></td>
                            <td><?= h($chatEntry->entry_key) ?></td>
                            <td><?= h($chatEntry->modified) ?></td>
                            <td><?= h($chatEntry->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ChatEntries', 'action' => 'view', $chatEntry->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ChatEntries', 'action' => 'edit', $chatEntry->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ChatEntries', 'action' => 'delete', $chatEntry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chatEntry->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>