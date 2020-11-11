<?php
declare(strict_types=1);

namespace App\Service\Tmdb;

use App\Model\Entity\Movie;
use App\Service\Tmdb\Builders\MovieBuilder;
use App\Service\Tmdb\Exceptions\InvalidMovieIdException;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Http\Client;

/**
 * Class TmdbService
 * @package App\Service\Tmdb
 */
class TmdbService
{
    const BASE_URL = 'https://api.themoviedb.org/3';
    /**
     * @var string
     */
    protected $api_key;

    /**
     * @var Client
     */
    protected $http;

    /**
     * TmdbService constructor.
     * @param string|null $api_key
     */
    public function __construct(string $api_key = null)
    {
        $this->api_key = $api_key ?? Configure::read('Tmdb.api_key');
        $this->http = new Client();
    }

    /**
     * @param string|int $movie_id
     * @return Movie
     */
    public function getMovie($movie_id): Movie
    {
        $url = $this->buildMovieUrl($movie_id, []);
        $data = $this->httpGet($url);
        if (isset($data['success']) && $data['success'] === false) {
            throw new InvalidMovieIdException(compact('movie_id'));
        }
        return MovieBuilder::buildFromRaw($data);
    }

    /**
     * @param $movie_id
     * @param array $args
     * @return string
     */
    protected function buildMovieUrl($movie_id, array $args = [])
    {
        return sprintf(
            '%s/movie/%s?api_key=%s&language=en-US&append_to_response=%s',
            self::BASE_URL,
            $movie_id,
            $this->api_key,
            'credits,external_ids,images,keywords,release_dates,videos,reviews'
        );
    }

    protected function httpGet(string $url)
    {
        $cache_key = md5($url);
        return Cache::remember($cache_key, function () use ($url) {
            $response = $this->http->get($url);
            return $response->getJson();
        });

    }

    protected function buildMovieInstance(array $data)
    {
        //movie
        // build and tie production companies
        // build person and cast and tie to movie
        // build person and crew and tie to movie
        // add external ids to people and movies
        // build and tie backdrop image then download
        // build and tie poster image then download
        // build and tie release dates, maybe
        // build and tie videos
        // iterate through review then build and tie each

    }
}
