<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ChatRooms Model
 *
 * @property \App\Model\Table\ChatEntriesTable&\Cake\ORM\Association\HasMany $ChatEntries
 *
 * @method \App\Model\Entity\ChatRoom newEmptyEntity()
 * @method \App\Model\Entity\ChatRoom newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatRoom> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ChatRoom get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ChatRoom findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ChatRoom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ChatRoom> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ChatRoom|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ChatRoom saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ChatRoom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatRoom>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatRoom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatRoom> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatRoom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatRoom>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ChatRoom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ChatRoom> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ChatRoomsTable extends Table
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

        $this->setTable('chat_rooms');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('ChatEntries', [
            'foreignKey' => 'chat_room_id',
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
            ->scalar('title')
            ->maxLength('title', 15)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('information')
            ->maxLength('information', 1000)
            ->allowEmptyString('information');

        $validator
            ->nonNegativeInteger('design')
            ->notEmptyString('design');

        $validator
            ->nonNegativeInteger('published')
            ->notEmptyString('published');

        $validator
            ->nonNegativeInteger('readonly')
            ->notEmptyString('readonly');

        $validator
            ->nonNegativeInteger('displayno')
            ->notEmptyString('displayno');

        $validator
            ->nonNegativeInteger('omikuji1flg')
            ->notEmptyString('omikuji1flg');

        $validator
            ->scalar('omikuji1name')
            ->maxLength('omikuji1name', 10)
            ->notEmptyString('omikuji1name');

        $validator
            ->scalar('omikuji1text')
            ->allowEmptyString('omikuji1text');

        $validator
            ->nonNegativeInteger('omikuji2flg')
            ->notEmptyString('omikuji2flg');

        $validator
            ->scalar('omikuji2name')
            ->maxLength('omikuji2name', 10)
            ->notEmptyString('omikuji2name');

        $validator
            ->scalar('omikuji2text')
            ->allowEmptyString('omikuji2text');

        $validator
            ->nonNegativeInteger('deck1flg')
            ->notEmptyString('deck1flg');

        $validator
            ->scalar('deck1name')
            ->maxLength('deck1name', 10)
            ->notEmptyString('deck1name');

        $validator
            ->scalar('deck1text')
            ->allowEmptyString('deck1text');

        return $validator;
    }
}
