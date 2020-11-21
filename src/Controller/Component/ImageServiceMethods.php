<?php
declare(strict_types=1);

namespace App\Controller\Component;

use App\Model\Entity\Image;
use App\Model\Entity\Movie;
use App\Model\Entity\Person;
use Cake\Cache\Cache;
use Cake\Core\Exception\Exception;

/**
 * Trait ImageServiceMethods
 * @package App\Controller\Component
 */
trait ImageServiceMethods
{

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
     * @param int $person_id
     * @param string $file_path
     * @return string
     */
    protected function getLocalPersonFile(int $person_id, string $file_path): string
    {
        $image_dir = $this->getPersonImageDir($person_id);
        $image_path = $image_dir . $file_path;
        if (!is_file($image_path)) {
            if (!is_dir($image_dir)) {
                mkdir($image_dir, 0755, true);
            }

            $tmdb_url = sprintf(
                '%s://image.tmdb.org/t/p/%s%s',
                $this->getRequest()->scheme(),
                $this->image_config['max_width']['profiles'],
                $file_path
            );

            $data = file_get_contents($tmdb_url);
            file_put_contents($image_path, $data);
        }
        return $image_path;
    }

    /**
     * @param int $id
     * @return string
     */
    protected function getPersonImageDir(int $id): string
    {
        return MOVIE_IMAGES_DIR . 'People' . DS . $id;
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
     * @param int $id
     * @return \App\Model\Entity\Movie|mixed
     */
    protected function getMovie(int $id): Movie
    {
        $cache_key = 'Movie_' . $id;
        if (($entity = Cache::read($cache_key)) === false) {
            $entity = $this->Movies->get($id);
            Cache::write($cache_key, $entity);
        }
        return $entity;
    }

    /**
     * @param int $id
     * @return Image
     */
    protected function getImage(int $id): Image
    {
        $cache_key = 'Image_' . $id;
        if (($entity = Cache::read($cache_key)) === false) {
            $entity = $this->Images->get($id);
            Cache::write($cache_key, $entity);
        }
        return $entity;
    }

    /**
     * @param int $id
     * @return Person
     */
    protected function getPerson(int $id): Person
    {
        $cache_key = 'Person_' . $id;
        if (($entity = Cache::read($cache_key)) === false) {
            $entity = $this->People->get($id);
            Cache::write($cache_key, $entity);
        }
        return $entity;
    }
}
