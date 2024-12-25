<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatCharacters Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChatEntriesTable&\Cake\ORM\Association\HasOne $ChatEntries
 * @property \App\Model\Table\BattleCharacterStatusesTable&\Cake\ORM\Association\HasMany $BattleCharacterStatuses
 * @property \App\Model\Table\BattleCharactersTable&\Cake\ORM\Association\HasMany $BattleCharacters
 * @property \App\Model\Table\BattleSaveSkillsTable&\Cake\ORM\Association\HasMany $BattleSaveSkills
 *
 * @method \App\Model\Entity\ChatCharacter newEmptyEntity()
 * @method \App\Model\Entity\ChatCharacter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatCharacter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatCharacter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ChatCharacter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ChatCharacter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatCharacter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatCharacter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ChatCharacter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ChatCharacter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatCharacter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatCharacter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatCharacter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatCharacter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatCharacter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatCharacter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatCharacter> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatCharactersTable extends Table
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

        $this->setTable('chat_characters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('ChatEntries', [
            'foreignKey' => 'chat_character_id',
            'joinType' => 'INNER',
        ]);
        $this->hasOne('BattleCharacterStatuses', [
            'foreignKey' => 'chat_character_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('BattleCharacters', [
            'foreignKey' => 'chat_character_id',
        ]);
        $this->hasMany('BattleSaveSkills', [
            'foreignKey' => 'chat_character_id',
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 50)
            ->requirePresence('fullname', 'create')
            ->notEmptyString('fullname');

        $validator
            ->scalar('sex')
            ->maxLength('sex', 7)
            ->allowEmptyString('sex');

        $validator
            ->scalar('color')
            ->maxLength('color', 7)
            ->notEmptyString('color');

        $validator
            ->scalar('backgroundcolor')
            ->maxLength('backgroundcolor', 7)
            ->notEmptyString('backgroundcolor');

        $validator
            ->scalar('nickname')
            ->maxLength('nickname', 20)
            ->allowEmptyString('nickname');

        $validator
            ->scalar('team')
            ->maxLength('team', 20)
            ->allowEmptyString('team');

        $validator
            ->scalar('tag')
            ->maxLength('tag', 255)
            ->allowEmptyString('tag');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->allowEmptyString('url');

        $validator
            ->scalar('free1')
            ->allowEmptyString('free1');

        $validator
            ->scalar('detail')
            ->allowEmptyString('detail');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
