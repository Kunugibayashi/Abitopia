<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BattleCorrectionConfigs Model
 *
 * @method \App\Model\Entity\BattleCorrectionConfig newEmptyEntity()
 * @method \App\Model\Entity\BattleCorrectionConfig newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleCorrectionConfig> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BattleCorrectionConfig get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\BattleCorrectionConfig findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\BattleCorrectionConfig patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\BattleCorrectionConfig> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\BattleCorrectionConfig|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\BattleCorrectionConfig saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\BattleCorrectionConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleCorrectionConfig>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleCorrectionConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleCorrectionConfig> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleCorrectionConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleCorrectionConfig>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\BattleCorrectionConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\BattleCorrectionConfig> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BattleCorrectionConfigsTable extends Table
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

        $this->setTable('battle_correction_configs');
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
            ->nonNegativeInteger('battle_correction_code')
            ->notEmptyString('battle_correction_code');

        $validator
            ->integer('battle_correction_value')
            ->notEmptyString('battle_correction_value');

        $validator
            ->nonNegativeInteger('active_flag')
            ->notEmptyString('active_flag');

        return $validator;
    }
}
