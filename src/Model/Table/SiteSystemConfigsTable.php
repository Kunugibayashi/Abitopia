<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SiteSystemConfigs Model
 *
 * @method \App\Model\Entity\SiteSystemConfig newEmptyEntity()
 * @method \App\Model\Entity\SiteSystemConfig newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SiteSystemConfig> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SiteSystemConfig get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SiteSystemConfig findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SiteSystemConfig patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SiteSystemConfig> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SiteSystemConfig|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SiteSystemConfig saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSystemConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSystemConfig>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSystemConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSystemConfig> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSystemConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSystemConfig>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SiteSystemConfig>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SiteSystemConfig> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SiteSystemConfigsTable extends Table
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

        $this->setTable('site_system_configs');
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
            ->nonNegativeInteger('site_rule_code')
            ->notEmptyString('site_rule_code');

        $validator
            ->nonNegativeInteger('active_flag')
            ->notEmptyString('active_flag');

        return $validator;
    }
}
