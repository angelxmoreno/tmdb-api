<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Reviewer Entity
 *
 * @property string $id
 * @property string|null $name
 * @property string|null $avatar_path
 * @property string|null $image_url
 * @property float|null $rating
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Review[] $reviews
 */
class Reviewer extends Entity
{
    protected $_virtual = ['image_url'];
    protected $_hidden = ['avatar_path', 'url'];

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
        'name' => true,
        'avatar_path' => true,
        'rating' => true,
        'created' => true,
        'modified' => true,
        'reviews' => true,
    ];


    protected function _getImageUrl()
    {
        return $this->avatar_path
            ? Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'ImageService',
                'action' => 'byReviewerId',
                $this->id . '.png'
            ], true)
            : null;
    }
}
