<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Image Entity
 *
 * @property int $id
 * @property string $foreign_model
 * @property int $foreign_uid
 * @property string $type
 * @property string $file_path
 * @property string $image_url
 * @property int|null $height
 * @property int|null $width
 * @property int|null $vote_count
 * @property float|null $vote_average
 * @property string|null $iso_639_1
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class Image extends Entity
{
    protected $_virtual = ['image_url'];
    protected $_hidden = ['foreign_model', 'foreign_uid', 'type', 'file_path'];

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
        'id' => true,
        'foreign_model' => true,
        'foreign_uid' => true,
        'type' => true,
        'file_path' => true,
        'height' => true,
        'width' => true,
        'vote_count' => true,
        'vote_average' => true,
        'iso_639_1' => true,
        'created' => true,
        'modified' => true,
    ];

    protected function _getImageUrl()
    {
        return Router::url([
            'prefix' => false,
            'plugin' => null,
            'controller' => 'ImageService',
            'action' => 'byImageId',
            $this->id . '.png'
        ], true);
    }
}
