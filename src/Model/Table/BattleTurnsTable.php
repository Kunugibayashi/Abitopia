<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BattleTurns Model
 *
 * @property \App\Model\Table\BattleCharactersTable&\Cake\ORM\Association\HasMany $BattleCharacters
 * @property \App\Model\Table\BattleSaveSkillsTable&\Cake\ORM\Association\HasMany $BattleSaveSkills
 *
 * @method \App\Model\Entity\BattleTurn newEmptyEntity()
 * @method \App\Model\Entity\BattleTurn newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleTurn> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BattleTurn get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BattleTurn findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BattleTurn patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleTurn> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BattleTurn|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BattleTurn saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BattleTurn>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleTurn>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleTurn>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleTurn> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleTurn>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleTurn>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleTurn>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleTurn> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BattleTurnsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('battle_turns');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('BattleCharacters', [
            'foreignKey' => 'battle_turn_id',
        ]);
        $this->hasMany('BattleSaveSkills', [
            'foreignKey' => 'battle_turn_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('vs_fukoku_key')
            ->notEmptyString('vs_fukoku_key');

        $validator
            ->nonNegativeInteger('vs_before_key')
            ->requirePresence('vs_before_key', 'create')
            ->notEmptyString('vs_before_key');

        $validator
            ->nonNegativeInteger('vs_after_key')
            ->requirePresence('vs_after_key', 'create')
            ->notEmptyString('vs_after_key');

        $validator
            ->nonNegativeInteger('battle_status')
            ->requirePresence('battle_status', 'create')
            ->notEmptyString('battle_status');

        $validator
            ->nonNegativeInteger('battle_turn_count')
            ->notEmptyString('battle_turn_count');

        $validator
            ->nonNegativeInteger('attack_chat_character_key')
            ->notEmptyString('attack_chat_character_key');

        $validator
            ->nonNegativeInteger('defense_chat_character_key')
            ->notEmptyString('defense_chat_character_key');

        return $validator;
    }
}
