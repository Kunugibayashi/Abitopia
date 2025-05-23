<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReceivedMessages Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ReceivedMessage newEmptyEntity()
 * @method \App\Model\Entity\ReceivedMessage newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ReceivedMessage> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMessage get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ReceivedMessage findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ReceivedMessage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ReceivedMessage> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReceivedMessage|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ReceivedMessage saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ReceivedMessage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ReceivedMessage>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ReceivedMessage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ReceivedMessage> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ReceivedMessage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ReceivedMessage>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ReceivedMessage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ReceivedMessage> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReceivedMessagesTable extends Table
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

        $this->setTable('received_messages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->nonNegativeInteger('user_id')
            ->notEmptyString('user_id');

        $validator
            ->nonNegativeInteger('chat_character_key')
            ->requirePresence('chat_character_key', 'create')
            ->notEmptyString('chat_character_key');

        $validator
            ->scalar('chat_character_fullname')
            ->maxLength('chat_character_fullname', 50)
            ->requirePresence('chat_character_fullname', 'create')
            ->notEmptyString('chat_character_fullname');

        $validator
            ->nonNegativeInteger('from_chat_character_key')
            ->requirePresence('from_chat_character_key', 'create')
            ->notEmptyString('from_chat_character_key');

        $validator
            ->scalar('from_chat_character_fullname')
            ->maxLength('from_chat_character_fullname', 50)
            ->requirePresence('from_chat_character_fullname', 'create')
            ->notEmptyString('from_chat_character_fullname');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

        $validator
            ->nonNegativeInteger('opend')
            ->notEmptyString('opend');

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
