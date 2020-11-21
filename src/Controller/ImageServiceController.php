<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Component\ImageServiceMethods;
use App\Model\Table\CompaniesTable;
use App\Model\Table\ImagesTable;
use App\Model\Table\MoviesTable;
use App\Model\Table\PeopleTable;
use App\Model\Table\ReviewersTable;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Http\Exception\NotFoundException;
use Cake\Utility\Inflector;

/**
 * Class ImageServiceController
 * @package App\Controller
 *
 * @property ImagesTable $Images
 * @property MoviesTable $Movies
 * @property PeopleTable $People
 * @property CompaniesTable $Companies
 * @property ReviewersTable $Reviewers
 */
class ImageServiceController extends AppController
{
    use ImageServiceMethods;

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
        $this->loadModel('People');
        $this->loadModel('Companies');
        $this->loadModel('Reviewers');
    }

    /**
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function byImageId(string $pseudo_image_file)
    {
        try {
            $id = $this->extractIntId($pseudo_image_file);
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
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();        }
    }

    /**
     * @param string $type
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function byMovieId(string $type, string $pseudo_image_file)
    {
        try {
            $id = $this->extractIntId($pseudo_image_file);
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
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();        }
    }

    /**
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function byPersonId(string $pseudo_image_file)
    {
        try {
            $id = $this->extractIntId($pseudo_image_file);
            $person = $this->getPerson($id);
            if (!$person->profile_path) {
                throw new Exception("File path from person is null");
            }

            $http_cached_response = $this->getImageResponseHeaders($person->modified);
            if ($http_cached_response->checkNotModified($this->getRequest())) {
                return $http_cached_response;
            }

            $file_path = $person->profile_path;

            $image_path = $this->getLocalPersonFile($person->id, $file_path);
            return $this->getImageResponse($image_path, $person->modified);
        } catch (\Exception $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();        }
    }

    /**
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function byCompanyId(string $pseudo_image_file)
    {
        try {
            $id = $this->extractIntId($pseudo_image_file);
            $entity = $this->getCompany($id);
            if (!$entity->get('logo_path')) {
                throw new Exception("File path from person is null");
            }

            $http_cached_response = $this->getImageResponseHeaders($entity->modified);
            if ($http_cached_response->checkNotModified($this->getRequest())) {
                return $http_cached_response;
            }

            $file_path = $entity->get('logo_path');

            $image_path = $this->getLocalCompanyFile($entity->id, $file_path);
            return $this->getImageResponse($image_path, $entity->modified);
        } catch (\Exception $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }


    /**
     * @param string $pseudo_image_file
     * @return \Cake\Http\Response|null
     * @throws \Exception
     */
    public function byReviewerId(string $pseudo_image_file)
    {
        try {
            $id = $this->extractStringId($pseudo_image_file);
            $entity = $this->getReviewer($id);
            if (!$entity->get('avatar_path')) {
                throw new Exception("File path from person is null");
            }

            $http_cached_response = $this->getImageResponseHeaders($entity->modified);
            if ($http_cached_response->checkNotModified($this->getRequest())) {
                return $http_cached_response;
            }

            $file_path = $entity->get('avatar_path');

            $image_path = $this->getLocalReviewerFile($entity->id, $file_path);
            return $this->getImageResponse($image_path, $entity->modified);
        } catch (\Exception $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }

}
