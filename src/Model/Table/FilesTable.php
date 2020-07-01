<?php
declare(strict_types=1);

namespace Lovesafe\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Files Model
 *
 * @property \Lovesafe\Model\Table\PasswordsTable&\Cake\ORM\Association\BelongsTo $Passwords
 * @property \Lovesafe\Model\Table\CommentsTable&\Cake\ORM\Association\HasMany $Comments
 *
 * @method \Lovesafe\Model\Entity\File newEmptyEntity()
 * @method \Lovesafe\Model\Entity\File newEntity(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\File[] newEntities(array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\File get($primaryKey, $options = [])
 * @method \Lovesafe\Model\Entity\File findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Lovesafe\Model\Entity\File patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\File[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Lovesafe\Model\Entity\File|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\File saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Lovesafe\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Lovesafe\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FilesTable extends Table
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

        $this->setTable('files');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Passwords', [
            'foreignKey' => 'password_id',
            'joinType' => 'INNER',
            'className' => 'Lovesafe.Passwords',
        ]);
        $this->hasMany('Comments', [
            'foreignKey' => 'file_id',
            'className' => 'Lovesafe.Comments',
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
            ->scalar('filename')
            ->maxLength('filename', 255)
            ->requirePresence('filename', 'create')
            ->notEmptyFile('filename');

        $validator
            ->scalar('url')
            ->maxLength('url', 255)
            ->requirePresence('url', 'create')
            ->notEmptyString('url');

        $validator
            ->scalar('filemime')
            ->maxLength('filemime', 24)
            ->requirePresence('filemime', 'create')
            ->notEmptyFile('filemime');

        $validator
            ->requirePresence('filesize', 'create')
            ->notEmptyFile('filesize');

        $validator
            ->numeric('k')
            ->requirePresence('k', 'create')
            ->notEmptyString('k');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->integer('allow_comments')
            ->notEmptyString('allow_comments');

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
