<?php
declare(strict_types=1);

namespace Lovesafe\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Passwords Model
 *
 * @property \Lovesafe\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 * @property \Lovesafe\Model\Table\FilesTable&\Cake\ORM\Association\HasMany $Files
 * @property \Lovesafe\Model\Table\TelephonesTable&\Cake\ORM\Association\HasMany $Telephones
 * @property \Lovesafe\Model\Table\UsersTable&\Cake\ORM\Association\HasMany $Users
 *
 * @method \Lovesafe\Model\Entity\Password newEmptyEntity()
 * @method \Lovesafe\Model\Entity\Password newEntity(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Password[] newEntities(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Password get($primaryKey, $options = [])
 * @method \Lovesafe\Model\Entity\Password findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Lovesafe\Model\Entity\Password patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Password[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\Password|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\Password saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\Password[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Password[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Password[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\Password[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PasswordsTable extends Table
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

        $this->setTable('passwords');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Comments', [
            'foreignKey' => 'password_id',
            'className' => 'Lovesafe.Comments',
        ]);
        $this->hasMany('Files', [
            'foreignKey' => 'password_id',
            'className' => 'Lovesafe.Files',
        ]);
        $this->hasMany('Telephones', [
            'foreignKey' => 'password_id',
            'className' => 'Lovesafe.Telephones',
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'password_id',
            'className' => 'Lovesafe.Users',
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
            ->scalar('pass')
            ->maxLength('pass', 32)
            ->requirePresence('pass', 'create')
            ->notEmptyString('pass');

        return $validator;
    }
}
