<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatLogs Model
 *
 * @property \App\Model\Table\BattleLogsTable&\Cake\ORM\Association\HasMany $BattleLogs
 *
 * @method \App\Model\Entity\ChatLog newEmptyEntity()
 * @method \App\Model\Entity\ChatLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ChatLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ChatLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ChatLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ChatLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatLogsTable extends Table
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

        $this->setTable('chat_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('BattleLogs', [
            'foreignKey' => 'chat_log_id',
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
            ->scalar('entry_key')
            ->maxLength('entry_key', 40)
            ->notEmptyString('entry_key');

        $validator
            ->nonNegativeInteger('chat_room_key')
            ->notEmptyString('chat_room_key');

        $validator
            ->scalar('chat_room_title')
            ->maxLength('chat_room_title', 15)
            ->notEmptyString('chat_room_title');

        $validator
            ->scalar('chat_room_information')
            ->maxLength('chat_room_information', 1000)
            ->allowEmptyString('chat_room_information');

        $validator
            ->scalar('color')
            ->maxLength('color', 7)
            ->notEmptyString('color');

        $validator
            ->scalar('backgroundcolor')
            ->maxLength('backgroundcolor', 11)
            ->notEmptyString('backgroundcolor');

        $validator
            ->nonNegativeInteger('chat_character_key')
            ->notEmptyString('chat_character_key');

        $validator
            ->scalar('fullname')
            ->maxLength('fullname', 50)
            ->allowEmptyString('fullname');

        $validator
            ->scalar('note')
            ->maxLength('note', 255)
            ->allowEmptyString('note');

        $validator
            ->scalar('message')
            ->maxLength('message', 3000)
            ->allowEmptyString('message');

        return $validator;
    }
}
