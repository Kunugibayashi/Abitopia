<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BattleLogs Model
 *
 * @property \App\Model\Table\ChatLogsTable&\Cake\ORM\Association\BelongsTo $ChatLogs
 *
 * @method \App\Model\Entity\BattleLog newEmptyEntity()
 * @method \App\Model\Entity\BattleLog newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleLog> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BattleLog get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BattleLog findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BattleLog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleLog> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BattleLog|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BattleLog saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BattleLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleLog>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleLog> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleLog>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleLog>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleLog> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BattleLogsTable extends Table
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

        $this->setTable('battle_logs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasOne('ChatLogs', [
            'foreignKey' => 'chat_log_id',
            'joinType' => 'LEFT',
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
            ->nonNegativeInteger('chat_log_id')
            ->notEmptyString('chat_log_id');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->scalar('narration')
            ->allowEmptyString('narration');

        $validator
            ->scalar('memo')
            ->allowEmptyString('memo');

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
        $rules->add($rules->existsIn(['chat_log_id'], 'ChatLogs'), ['errorField' => 'chat_log_id']);

        return $rules;
    }
}
