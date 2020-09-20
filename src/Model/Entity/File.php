<?php
declare(strict_types=1);

namespace Lovesafe\Model\Entity;

use Cake\ORM\Entity;

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Lovesafe\Plugin as LovesafePlugin;

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
     * Поля, которые могут быть массово назначены с помощью newEntity() or patchEntity().
     *
     * Обратите внимание, что если '*' имеет значение true, то это позволяет массово назначать все неопределенные поля. В целях безопасности * * рекомендуется установить '*' в значение false (или удалить его) и явно сделать отдельные поля доступными по мере необходимости.
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

    /**
     * Аксессор "url".
     */
    protected function _getUrl( $url )
    {
        return $url;
    }

    /**
     * Аксессор "filemime".
     */
    protected function _getFilemime( $filemime )
    {
        return $filemime;
    }

    /**
     * Аксессор "small_url".
     */
    protected function _getSmallUrl()
    {
        $part1 = substr( $this->url, 0, 2 );
        $part2 = substr( $this->url, 2, 2 );
        $end = substr( $this->url, 4 );
        $url = $part1 . '-' . $part2 . '-' . $end;

        // Загружаем файл конфигурации 'files_default'.
        // use Lovesafe\Plugin as LovesafePlugin;
        $plugin = new LovesafePlugin();
        Configure::config( 'default', new PhpConfig( $plugin->getPath() . 'config/' ) );
        Configure::load( 'upload_files_default' );
        $ext = Configure::read( 'ext' );

        // Ищем в массиве конфигурации расширение файла.
        foreach( $ext as $key => $val ) {
            $key_ = array_search( $this->filemime, $ext[$key] );
            if ( $key_ !== false ) break;
        }

        return DS . 'img' . DS . 'small-' . $url . '.' . $key;
    }
}
