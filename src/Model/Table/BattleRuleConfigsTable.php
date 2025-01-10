<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BattleRuleConfigs Model
 *
 * @method \App\Model\Entity\BattleRuleConfig newEmptyEntity()
 * @method \App\Model\Entity\BattleRuleConfig newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleRuleConfig> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BattleRuleConfig get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BattleRuleConfig findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BattleRuleConfig patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleRuleConfig> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BattleRuleConfig|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BattleRuleConfig saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BattleRuleConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleRuleConfig>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleRuleConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleRuleConfig> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleRuleConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleRuleConfig>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleRuleConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleRuleConfig> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BattleRuleConfigsTable extends Table
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

        $this->setTable('battle_rule_configs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->nonNegativeInteger('battle_rule_code')
            ->notEmptyString('battle_rule_code');

        $validator
            ->nonNegativeInteger('active_flag')
            ->notEmptyString('active_flag');

        return $validator;
    }
}
