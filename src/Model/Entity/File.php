<?php
declare(strict_types=1);

namespace Lovesafe\Model\Entity;

use Cake\ORM\Entity;

/**
 * File Entity
 *
 * @property int $id
 * @property int $password_id
 * @property string $filename
 * @property string $url
 * @property string $filemime
 * @property int $filesize
 * @property float $k
 * @property int $status
 * @property int $allow_comments
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \Lovesafe\Model\Entity\Password $password
 * @property \Lovesafe\Model\Entity\Comment[] $comments
 */
class File extends Entity
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
        'filename' => true,
        'url' => true,
        'filemime' => true,
        'filesize' => true,
        'k' => true,
        'status' => true,
        'allow_comments' => true,
        'created' => true,
        'modified' => true,
        'password' => true,
        'comments' => true,
    ];
}
