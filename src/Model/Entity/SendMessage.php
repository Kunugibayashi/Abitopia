<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SendMessage Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $chat_character_key
 * @property string $chat_character_fullname
 * @property int $to_chat_character_key
 * @property string $to_chat_character_fullname
 * @property string $title
 * @property string $message
 * @property \Cake\I18n\DateTime $modified
 * @property \Cake\I18n\DateTime $created
 *
 * @property \App\Model\Entity\User $user
 */
class SendMessage extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'chat_character_key' => true,
        'chat_character_fullname' => true,
        'to_chat_character_key' => true,
        'to_chat_character_fullname' => true,
        'title' => true,
        'message' => true,
        'modified' => true,
        'created' => true,
        'user' => true,
    ];
}
