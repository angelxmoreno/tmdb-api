<?php
declare(strict_types=1);

namespace App\Service\Tmdb;

use App\Model\Entity\Movie;
use App\Service\Tmdb\Builders\MovieBuilder;
use App\Service\Tmdb\Exceptions\InvalidMovieIdException;
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Utility\Hash;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

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
     * @var HttpClientInterface
     */
    protected $http;

    /**
     * TmdbService constructor.
     * @param string|null $api_key
     */
    public function __construct(string $api_key = null)
    {
        $this->api_key = $api_key ?? Configure::read('Tmdb.api_key');
        $this->http = new CurlHttpClient();
    }

    /**
     * @param int $movie_id
     * @return Movie
     * @throws \Exception
     */
    public function getMovie(int $movie_id): Movie
    {
        $url = $this->buildMovieUrl($movie_id, [
            'include_image_language' => 'en',
            'append_to_response' => 'credits,external_ids,images,keywords,release_dates,videos,reviews'
        ]);
        $data = $this->httpGet($url);
        if (isset($data['success']) && $data['success'] === false) {
            throw new InvalidMovieIdException(compact('movie_id'));
        }
        return MovieBuilder::buildFromRaw($data);
    }

    /**
     * @param int $movie_id
     * @param array $args
     * @return string
     */
    protected function buildMovieUrl(int $movie_id, array $args = []): string
    {
        $args = array_merge($args, [
            'language' => 'en-US',
            'api_key' => $this->api_key
        ]);
        $url = sprintf(
            '%s/movie/%s',
            self::BASE_URL,
            $movie_id
        );
        return $url . '?' . http_build_query($args);
    }

    /**
     * @param string $url
     * @return array
     */
    protected function httpGet(string $url)
    {
        $cache_key = md5($url);
        return Cache::remember($cache_key, function () use ($url) {
            $response = $this->http->request('GET', $url);

            return $response->toArray();
        });
    }

    /**
     * @param int $movie_id
     * @param int $page
     * @return array
     */
    public function getMovieReviews(int $movie_id, int $page = 1): array
    {
        $url = $this->buildMovieReviewsUrl($movie_id, $page);
        $data = $this->httpGet($url);
        if (isset($data['success']) && $data['success'] === false) {
            throw new InvalidMovieIdException(compact('movie_id'));
        }
        $ids = Hash::extract($data, 'results.{n}.id');
        $data['results'] = $this->bulkGetReviewsByIds($ids);

        return $data;
    }

    /**
     * @param int $movie_id
     * @param int $page
     * @return string
     */
    protected function buildMovieReviewsUrl(int $movie_id, int $page = 1): string
    {
        $args = [
            'page' => $page,
            'language' => 'en-US',
            'api_key' => $this->api_key
        ];
        $url = sprintf(
            '%s/movie/%s/reviews',
            self::BASE_URL,
            $movie_id
        );
        return $url . '?' . http_build_query($args);
    }

    /**
     * @param array $review_ids
     * @return array
     */
    protected function bulkGetReviewsByIds(array $review_ids)
    {
        $cache_key = md5(serialize($review_ids));
        return Cache::remember($cache_key, function () use ($review_ids) {

            $results = [];

            try {
                $responses = [];
                foreach ($review_ids as $review_id) {
                    $url = $this->buildSingleReviewUrl($review_id);
                    $responses[] = $this->http->request('GET', $url);
                }

                foreach ($responses as $response) {
                    $results[] = $response->toArray();
                }
            } catch (\Exception $e) {
            } catch (TransportExceptionInterface $e) {
            } catch (ClientExceptionInterface $e) {
            } catch (DecodingExceptionInterface $e) {
            } catch (RedirectionExceptionInterface $e) {
            } catch (ServerExceptionInterface $e) {
            }

            return $results;
        });

    }

    /**
     * @param string $review_id
     * @return string
     */
    protected function buildSingleReviewUrl(string $review_id): string
    {
        $args = [
            'language' => 'en-US',
            'api_key' => $this->api_key
        ];
        $url = sprintf(
            '%s/review/%s',
            self::BASE_URL,
            $review_id
        );
        return $url . '?' . http_build_query($args);
    }

    protected function buildMovieInstance(array $data)
    {
        //movie
        // add external ids to people and movies
        // build and tie release dates, maybe

    }
}
