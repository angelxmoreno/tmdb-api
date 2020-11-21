<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Routing\Router;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo_path
 * @property string|null $origin_country
 * @property string $payload
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Movie[] $movies
 */
class Company extends Entity
{
    protected $_virtual = ['logo_image_url'];
    protected $_hidden = ['payload', 'logo_path'];

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
        'logo_path' => true,
        'origin_country' => true,
        'payload' => true,
        'created' => true,
        'modified' => true,
        'movies' => true,
    ];


    protected function _getLogoImageUrl()
    {
        return $this->logo_path
            ? Router::url([
                'prefix' => false,
                'plugin' => null,
                'controller' => 'ImageService',
                'action' => 'byCompanyId',
                $this->id . '.png'
            ], true)
            : null;
    }
}
