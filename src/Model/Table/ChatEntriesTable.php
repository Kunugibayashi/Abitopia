<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatEntries Model
 *
 * @property \App\Model\Table\ChatRoomsTable&\Cake\ORM\Association\BelongsTo $ChatRooms
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\ChatCharactersTable&\Cake\ORM\Association\BelongsTo $ChatCharacters
 *
 * @method \App\Model\Entity\ChatEntry newEmptyEntity()
 * @method \App\Model\Entity\ChatEntry newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatEntry> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatEntry get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ChatEntry findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ChatEntry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatEntry> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatEntry|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ChatEntry saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ChatEntry>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatEntry>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatEntry>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatEntry> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatEntry>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatEntry>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatEntry>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatEntry> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatEntriesTable extends Table
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

        $this->setTable('chat_entries');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('ChatRooms', [
            'foreignKey' => 'chat_room_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChatCharacters', [
            'foreignKey' => 'chat_character_id',
            'joinType' => 'INNER',
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
            ->nonNegativeInteger('chat_room_id')
            ->notEmptyString('chat_room_id');

        $validator
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->nonNegativeInteger('chat_character_id')
            ->notEmptyString('chat_character_id')
            ->add('chat_character_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('entry_key')
            ->maxLength('entry_key', 40)
            ->requirePresence('entry_key', 'create')
            ->notEmptyString('entry_key');

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
        $rules->add($rules->isUnique(['chat_character_id']), ['errorField' => 'chat_character_id']);
        $rules->add($rules->existsIn(['chat_room_id'], 'ChatRooms'), ['errorField' => 'chat_room_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['chat_character_id'], 'ChatCharacters'), ['errorField' => 'chat_character_id']);

        return $rules;
    }
}
