<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($user->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Chat Characters') ?></h4>
                <?php if (!empty($user->chat_characters)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Fullname') ?></th>
                            <th><?= __('Sex') ?></th>
                            <th><?= __('Color') ?></th>
                            <th><?= __('Backgroundcolor') ?></th>
                            <th><?= __('Nickname') ?></th>
                            <th><?= __('Team') ?></th>
                            <th><?= __('Tag') ?></th>
                            <th><?= __('Url') ?></th>
                            <th><?= __('Free1') ?></th>
                            <th><?= __('Detail') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->chat_characters as $chatCharacter) : ?>
                        <tr>
                            <td><?= h($chatCharacter->id) ?></td>
                            <td><?= h($chatCharacter->user_id) ?></td>
                            <td><?= h($chatCharacter->fullname) ?></td>
                            <td><?= h($chatCharacter->sex) ?></td>
                            <td><?= h($chatCharacter->color) ?></td>
                            <td><?= h($chatCharacter->backgroundcolor) ?></td>
                            <td><?= h($chatCharacter->nickname) ?></td>
                            <td><?= h($chatCharacter->team) ?></td>
                            <td><?= h($chatCharacter->tag) ?></td>
                            <td><?= h($chatCharacter->url) ?></td>
                            <td><?= h($chatCharacter->free1) ?></td>
                            <td><?= h($chatCharacter->detail) ?></td>
                            <td><?= h($chatCharacter->modified) ?></td>
                            <td><?= h($chatCharacter->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ChatCharacters', 'action' => 'view', $chatCharacter->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ChatCharacters', 'action' => 'edit', $chatCharacter->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ChatCharacters', 'action' => 'delete', $chatCharacter->id], ['confirm' => __('Are you sure you want to delete # {0}?', $chatCharacter->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Chat Entries') ?></h4>
                <?php if (!empty($user->chat_entries)) : ?>
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
                        <?php foreach ($user->chat_entries as $chatEntry) : ?>
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
            <div class="related">
                <h4><?= __('Related Received Messages') ?></h4>
                <?php if (!empty($user->received_messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Chat Character Key') ?></th>
                            <th><?= __('Chat Character Fullname') ?></th>
                            <th><?= __('From Chat Character Key') ?></th>
                            <th><?= __('From Chat Character Fullname') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Message') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->received_messages as $receivedMessage) : ?>
                        <tr>
                            <td><?= h($receivedMessage->id) ?></td>
                            <td><?= h($receivedMessage->user_id) ?></td>
                            <td><?= h($receivedMessage->chat_character_key) ?></td>
                            <td><?= h($receivedMessage->chat_character_fullname) ?></td>
                            <td><?= h($receivedMessage->from_chat_character_key) ?></td>
                            <td><?= h($receivedMessage->from_chat_character_fullname) ?></td>
                            <td><?= h($receivedMessage->title) ?></td>
                            <td><?= h($receivedMessage->message) ?></td>
                            <td><?= h($receivedMessage->modified) ?></td>
                            <td><?= h($receivedMessage->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ReceivedMessages', 'action' => 'view', $receivedMessage->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ReceivedMessages', 'action' => 'edit', $receivedMessage->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReceivedMessages', 'action' => 'delete', $receivedMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receivedMessage->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Send Messages') ?></h4>
                <?php if (!empty($user->send_messages)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Chat Character Key') ?></th>
                            <th><?= __('Chat Character Fullname') ?></th>
                            <th><?= __('To Chat Character Key') ?></th>
                            <th><?= __('To Chat Character Fullname') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Message') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->send_messages as $sendMessage) : ?>
                        <tr>
                            <td><?= h($sendMessage->id) ?></td>
                            <td><?= h($sendMessage->user_id) ?></td>
                            <td><?= h($sendMessage->chat_character_key) ?></td>
                            <td><?= h($sendMessage->chat_character_fullname) ?></td>
                            <td><?= h($sendMessage->to_chat_character_key) ?></td>
                            <td><?= h($sendMessage->to_chat_character_fullname) ?></td>
                            <td><?= h($sendMessage->title) ?></td>
                            <td><?= h($sendMessage->message) ?></td>
                            <td><?= h($sendMessage->modified) ?></td>
                            <td><?= h($sendMessage->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SendMessages', 'action' => 'view', $sendMessage->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SendMessages', 'action' => 'edit', $sendMessage->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'SendMessages', 'action' => 'delete', $sendMessage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sendMessage->id)]) ?>
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