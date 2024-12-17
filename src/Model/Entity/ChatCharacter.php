<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ChatCharacter Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $fullname
 * @property string $sex
 * @property string $color
 * @property string $backgroundcolor
 * @property string|null $nickname
 * @property string|null $team
 * @property string|null $tag
 * @property string|null $url
 * @property string|null $free1
 * @property string|null $detail
 * @property \Cake\I18n\DateTime $modified
 * @property \Cake\I18n\DateTime $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\BattleCharacterStatus $battle_character_status
 * @property \App\Model\Entity\BattleCharacter[] $battle_characters
 * @property \App\Model\Entity\BattleSaveSkill[] $battle_save_skills
 * @property \App\Model\Entity\ChatEntry $chat_entry
 */
class ChatCharacter extends Entity
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
        'fullname' => true,
        'sex' => true,
        'color' => true,
        'backgroundcolor' => true,
        'nickname' => true,
        'team' => true,
        'tag' => true,
        'url' => true,
        'free1' => true,
        'detail' => true,
        'modified' => true,
        'created' => true,
        'user' => true,
        'battle_character_status' => true,
        'battle_characters' => true,
        'battle_save_skills' => true,
        'chat_entry' => true,
    ];
}
