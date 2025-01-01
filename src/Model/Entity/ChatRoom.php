<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChatRoom Entity
 *
 * @property int $id
 * @property string $title
 * @property string|null $information
 * @property int $design
 * @property int $published
 * @property int $readonly
 * @property int $displayno
 * @property int $omikuji1flg
 * @property string $omikuji1name
 * @property string|null $omikuji1text
 * @property int $omikuji2flg
 * @property string $omikuji2name
 * @property string|null $omikuji2text
 * @property int $deck1flg
 * @property string $deck1name
 * @property string|null $deck1text
 * @property \Cake\I18n\DateTime $modified
 * @property \Cake\I18n\DateTime $created
 *
 * @property \App\Model\Entity\ChatEntry[] $chat_entries
 */
class ChatRoom extends Entity
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
        'title' => true,
        'information' => true,
        'design' => true,
        'published' => true,
        'readonly' => true,
        'displayno' => true,
        'omikuji1flg' => true,
        'omikuji1name' => true,
        'omikuji1text' => true,
        'omikuji2flg' => true,
        'omikuji2name' => true,
        'omikuji2text' => true,
        'deck1flg' => true,
        'deck1name' => true,
        'deck1text' => true,
        'modified' => true,
        'created' => true,
        'chat_entries' => true,
    ];
}
