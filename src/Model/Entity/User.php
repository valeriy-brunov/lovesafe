<?php
declare(strict_types=1);

namespace Lovesafe\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $password_id
 * @property string $name
 * @property string $sex
 * @property \Cake\I18n\FrozenDate $birthday
 * @property int $town
 * @property int|null $height
 * @property int|null $weight
 * @property string $constitution
 * @property string $eyecolor
 * @property string $haircolor
 * @property string $onbody
 * @property string $relationship
 * @property string $children
 * @property string $housing
 * @property string $car
 * @property string $ilooking
 * @property string $myincome
 * @property string $education
 * @property string|null $fieldactivity
 * @property string $smoking
 * @property string $alcohol
 * @property string|null $aboutyouself
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Lovesafe\Model\Entity\Password $password
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'password_id' => true,
        'name' => true,
        'sex' => true,
        'birthday' => true,
        'town' => true,
        'height' => true,
        'weight' => true,
        'constitution' => true,
        'eyecolor' => true,
        'haircolor' => true,
        'onbody' => true,
        'relationship' => true,
        'children' => true,
        'housing' => true,
        'car' => true,
        'ilooking' => true,
        'myincome' => true,
        'education' => true,
        'fieldactivity' => true,
        'smoking' => true,
        'alcohol' => true,
        'aboutyouself' => true,
        'created' => true,
        'modified' => true,
        'password' => true,
    ];
}
