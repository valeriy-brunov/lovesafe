<?php
declare(strict_types=1);

namespace Lovesafe\Model\Entity;

use Cake\ORM\Entity;

/**
 * Password Entity
 *
 * @property int $id
 * @property string $pass
 *
 * @property \Lovesafe\Model\Entity\Comment[] $comments
 * @property \Lovesafe\Model\Entity\File[] $files
 * @property \Lovesafe\Model\Entity\Telephone[] $telephones
 * @property \Lovesafe\Model\Entity\User[] $users
 */
class Password extends Entity
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
        'pass' => true,
        'comments' => true,
        'files' => true,
        'telephones' => true,
        'users' => true,
    ];
}
