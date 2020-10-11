<?php
declare(strict_types=1);

namespace Lovesafe\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Lovesafe\Model\Table\PasswordsTable&\Cake\ORM\Association\BelongsTo $Passwords
 *
 * @method \Lovesafe\Model\Entity\User newEmptyEntity()
 * @method \Lovesafe\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\User get($primaryKey, $options = [])
 * @method \Lovesafe\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Lovesafe\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->scalar('name')
            ->maxLength('name', 100)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('sex')
            ->requirePresence('sex', 'create')
            ->notEmptyString('sex');

        $validator
            ->date('birthday')
            ->requirePresence('birthday', 'create')
            ->notEmptyDate('birthday');

        $validator
            ->integer('town')
            ->requirePresence('town', 'create')
            ->notEmptyString('town');

        $validator
            ->integer('height')
            ->allowEmptyString('height');

        $validator
            ->integer('weight')
            ->allowEmptyString('weight');

        $validator
            ->scalar('constitution')
            ->notEmptyString('constitution');

        $validator
            ->scalar('eyecolor')
            ->notEmptyString('eyecolor');

        $validator
            ->scalar('haircolor')
            ->notEmptyString('haircolor');

        $validator
            ->scalar('onbody')
            ->requirePresence('onbody', 'create')
            ->notEmptyString('onbody');

        $validator
            ->scalar('relationship')
            ->notEmptyString('relationship');

        $validator
            ->scalar('children')
            ->notEmptyString('children');

        $validator
            ->scalar('housing')
            ->notEmptyString('housing');

        $validator
            ->scalar('car')
            ->notEmptyString('car');

        $validator
            ->scalar('ilooking')
            ->requirePresence('ilooking', 'create')
            ->notEmptyString('ilooking');

        $validator
            ->scalar('myincome')
            ->notEmptyString('myincome');

        $validator
            ->scalar('education')
            ->notEmptyString('education');

        $validator
            ->scalar('fieldactivity')
            ->maxLength('fieldactivity', 255)
            ->allowEmptyString('fieldactivity');

        $validator
            ->scalar('smoking')
            ->notEmptyString('smoking');

        $validator
            ->scalar('alcohol')
            ->requirePresence('alcohol', 'create')
            ->notEmptyString('alcohol');

        $validator
            ->scalar('aboutyouself')
            ->maxLength('aboutyouself', 255)
            ->allowEmptyString('aboutyouself');

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
        $rules->add($rules->existsIn(['password_id'], 'Passwords'));

        return $rules;
    }
}
