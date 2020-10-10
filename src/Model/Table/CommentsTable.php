<?php
declare(strict_types=1);

namespace Lovesafe\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comments Model
 *
 * @property \Lovesafe\Model\Table\FilesTable&\Cake\ORM\Association\BelongsTo $Files
 * @property \Lovesafe\Model\Table\PasswordsTable&\Cake\ORM\Association\BelongsTo $Passwords
 *
 * @method \Lovesafe\Model\Entity\Comment newEmptyEntity()
 * @method \Lovesafe\Model\Entity\Comment newEntity(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Comment[] newEntities(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Comment get($primaryKey, $options = [])
 * @method \Lovesafe\Model\Entity\Comment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Lovesafe\Model\Entity\Comment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Comment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Comment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\Comment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('comments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Files', [
            'foreignKey' => 'file_id',
            'joinType' => 'INNER',
            'className' => 'Lovesafe.Files',
        ]);
        $this->belongsTo('Passwords', [
            'foreignKey' => 'password_id',
            'joinType' => 'INNER',
            'className' => 'Lovesafe.Passwords',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('text')
            ->requirePresence('text', 'create')
            ->notEmptyString('text');

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
        $rules->add($rules->existsIn(['file_id'], 'Files'));
        $rules->add($rules->existsIn(['password_id'], 'Passwords'));

        return $rules;
    }
}
