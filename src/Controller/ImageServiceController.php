<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\ImagesTable;
use Cake\Http\Exception\NotFoundException;

/**
 * Class ImageServiceController
 * @package App\Controller
 *
 * @property ImagesTable $Images
 */
class ImageServiceController extends AppController
{
    protected $image_config = [
        'base_url' => "http://image.tmdb.org/t/p/",
        'secure_base_url' => "https://image.tmdb.org/t/p/",
        'max_width' => [
            'backdrops' => "w1280",
            'logos' => "w500",
            'posters' => "w780",
            'profiles' => "w185",
            'stills' => "w300",
        ],
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow();
        $this->loadModel('Images');
    }

    /**
     * @param $image_id
     * @return \Cake\Http\Response|null
     */
    public function byImageId($image_id)
    {
        $matched = preg_match('~^(\d+)\.png$~', $image_id, $matches);
        if (!$matched) {
            throw new NotFoundException('Image not found');
        }
        $image = $this->Images->get($matches[1]);
        $image_dir = MOVIE_IMAGES_DIR . $image->foreign_model . DS . $image->foreign_uid . DS . $image->type;
        $image_path = $image_dir . $image->file_path;
        $tmdb_url = sprintf(
            '%s://image.tmdb.org/t/p/%s%s',
            $this->getRequest()->scheme(),
            $this->image_config['max_width'][$image->type],
            $image->file_path
        );

        if (!is_file($image_path)) {
            if (!is_dir($image_dir)) {
                mkdir($image_dir, 0755, true);
            }
            $data = file_get_contents($tmdb_url);
            file_put_contents($image_path, $data);
        }

        return $this->getResponse()
            ->withSharable(true, 60 * 60 * 24 * 365)
            ->withExpires('+365 days')
            ->withModified($image->modified)
            ->withEtag(md5($image->modified->toDateString()))
            ->withFile($image_path);
    }
}
