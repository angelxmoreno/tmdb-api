<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Person Entity
 *
 * @property int $id
 * @property string $name
 * @property bool|null $is_adult
 * @property string|null $biography
 * @property string|null $gender
 * @property string|null $homepage
 * @property string|null $imdb_uid
 * @property string|null $known_for_department
 * @property string|null $place_of_birth
 * @property float|null $popularity
 * @property string|null $profile_path
 * @property string|null $image_url
 * @property string $payload
 * @property \Cake\I18n\FrozenDate|null $birthday
 * @property \Cake\I18n\FrozenDate|null $deathday
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Cast[] $casts
 * @property \App\Model\Entity\Crew[] $crews
 */
class Person extends Entity
{
    protected $_virtual = ['image_url'];
    protected $_hidden = ['payload', 'profile_path'];

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
        'is_adult' => true,
        'biography' => true,
        'gender' => true,
        'homepage' => true,
        'imdb_uid' => true,
        'known_for_department' => true,
        'place_of_birth' => true,
        'popularity' => true,
        'profile_path' => true,
        'payload' => true,
        'birthday' => true,
        'deathday' => true,
        'created' => true,
        'modified' => true,
        'casts' => true,
        'crews' => true,
    ];

    protected function _getImageUrl()
    {
        return $this->profile_path
            ? Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'ImageService',
                'action' => 'byPersonId',
                $this->id . '.png'
            ], true)
            : null;
    }
}
