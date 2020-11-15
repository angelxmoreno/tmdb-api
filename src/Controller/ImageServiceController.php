<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Image;
use App\Model\Entity\Movie;
use App\Model\Table\ImagesTable;
use App\Model\Table\MoviesTable;
use Cake\Cache\Cache;
use Cake\Core\Exception\Exception;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Inflector;

/**
 * Class ImageServiceController
 * @package App\Controller
 *
 * @property ImagesTable $Images
 * @property MoviesTable $Movies
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
        $this->loadModel('Movies');
    }

    /**
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     */
    public function byImageId(string $pseudo_image_file)
    {
        try {
            $id = $this->extractId($pseudo_image_file);
            $image = $this->Images->get($id);
            $file_path = $image->file_path;
            $type = $image->type;

            $http_cached_response = $this->getImageResponseHeaders($image->modified);
            if ($http_cached_response->checkNotModified($this->getRequest())) {
                return $http_cached_response;
            }

            switch ($image->foreign_model) {
                case 'Movies':
                    $movie_id = $image->foreign_uid;
                    $image_path = $this->getLocalMovieFile($type, $movie_id, $file_path);
                    return $this->getImageResponse($image_path, $image->modified);
                    break;

                default:
                    throw new Exception('Unknown foreign_model');
                    break;
            }
        } catch (\Exception $e) {
            throw new NotFoundException();
        }
    }

    /**
     * @param string $pseudo_image_file
     * @return int
     */
    protected function extractId(string $pseudo_image_file): int
    {
        $matched = preg_match('~^(\d+)\.png$~', $pseudo_image_file, $matches);
        if (!$matched) {
            throw new Exception("Can not extract id from pseudo image file");
        }
        return (int)$matches[1];
    }

    /**
     * @param \DateTimeInterface $modified
     * @return \Cake\Http\Response|null
     */
    protected function getImageResponseHeaders(\DateTimeInterface $modified)
    {
        return $this->getResponse()
            ->withSharable(true, 60 * 60 * 24 * 365)
            ->withExpires('+365 days')
            ->withModified($modified)
            ->withEtag(md5($modified->format(\DATE_W3C)));
    }

    /**
     * @param string $type
     * @param int $movie_id
     * @param string $file_path
     * @return string
     */
    protected function getLocalMovieFile(string $type, int $movie_id, string $file_path): string
    {
        $image_dir = $this->getMovieImageDir($type, $movie_id);
        $image_path = $image_dir . $file_path;
        if (!is_file($image_path)) {
            if (!is_dir($image_dir)) {
                mkdir($image_dir, 0755, true);
            }

            $tmdb_url = sprintf(
                '%s://image.tmdb.org/t/p/%s%s',
                $this->getRequest()->scheme(),
                $this->image_config['max_width'][$type],
                $file_path
            );

            $data = file_get_contents($tmdb_url);
            file_put_contents($image_path, $data);
        }
        return $image_path;
    }

    /**
     * @param string $type
     * @param int $id
     * @return string
     */
    protected function getMovieImageDir(string $type, int $id): string
    {
        return MOVIE_IMAGES_DIR . 'Movies' . DS . $id . DS . $type;
    }

    /**
     * @param string $image_path
     * @param \DateTimeInterface $modified
     * @return \Cake\Http\Response|null
     */
    protected function getImageResponse(string $image_path, \DateTimeInterface $modified)
    {
        return $this->getImageResponseHeaders($modified)->withFile($image_path);
    }

    /**
     * @param string $type
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     */
    public function byMovieId(string $type, string $pseudo_image_file)
    {
        try {
            $id = $this->extractId($pseudo_image_file);
            $movie = $this->getMovie($id);
            if (!$movie->has(Inflector::singularize($type) . '_path')) {
                throw new Exception("File path from movie is null");
            }

            $http_cached_response = $this->getImageResponseHeaders($movie->modified);
            if ($http_cached_response->checkNotModified($this->getRequest())) {
                return $http_cached_response;
            }

            $file_path = $movie->get(Inflector::singularize($type) . '_path');

            $image_path = $this->getLocalMovieFile($type, $movie->id, $file_path);
            return $this->getImageResponse($image_path, $movie->modified);
        } catch (\Exception $e) {
            throw new NotFoundException();
        }
    }

    /**
     * @param int $id
     * @return \App\Model\Entity\Movie|mixed
     */
    protected function getMovie(int $id): Movie
    {
        $cache_key = 'Movie_' . $id;
        if (($movie = Cache::read($cache_key)) === false) {
            $movie = $this->Movies->get($id);
            Cache::write($cache_key, $movie);
        }
        return $movie;
    }

    /**
     * @param int $id
     * @return Image
     */
    protected function getImage(int $id): Image
    {
        $cache_key = 'Image_' . $id;
        if (($image = Cache::read($cache_key)) === false) {
            $image = $this->Images->get($id);
            Cache::write($cache_key, $image);
        }
        return $image;
    }
}
