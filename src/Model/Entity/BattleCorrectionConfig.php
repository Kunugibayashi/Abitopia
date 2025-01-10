<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BattleCorrectionConfig Entity
 *
 * @property int $id
 * @property int $battle_correction_code
 * @property int $battle_correction_value
 * @property int $active_flag
 * @property \Cake\I18n\DateTime $modified
 * @property \Cake\I18n\DateTime $created
 */
class BattleCorrectionConfig extends Entity
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
        'battle_correction_code' => true,
        'battle_correction_value' => true,
        'active_flag' => true,
        'modified' => true,
        'created' => true,
    ];
}
