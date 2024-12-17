<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Informations Model
 *
 * @method \App\Model\Entity\Information newEmptyEntity()
 * @method \App\Model\Entity\Information newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Information> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Information get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Information findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Information patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Information> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Information|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Information saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Information>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Information>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Information>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Information> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Information>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Information>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Information>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Information> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InformationsTable extends Table
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

        $this->setTable('informations');
        $this->setDisplayField('title');
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
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('detail')
            ->requirePresence('detail', 'create')
            ->notEmptyString('detail');

        return $validator;
    }
}
