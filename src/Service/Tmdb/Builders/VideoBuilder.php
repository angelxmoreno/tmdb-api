<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Entity\Movie;
use Cake\Utility\Hash;

/**
 * Class VideoBuilder
 * @package App\Service\Tmdb\Builders
 */
class VideoBuilder extends BuilderBase
{
    const TABLE_NAME = 'Videos';

    /**
     * @param Movie $movie
     * @param array $data
     * @return \App\Model\Entity\Video[]
     * @throws \Exception
     */
    public static function buildFromRaw(Movie $movie, array $data): array
    {
        $video_data = Hash::get($data, 'videos.results');
        $video_data = \collection($video_data)->map(function ($row) use ($movie) {
            $row['movie_id'] = $movie->id;
            return $row;
        })->toArray();
        return self::save($video_data);
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Video[]
     * @throws \Exception
     */
    protected static function save(array $data): array
    {
        $entities = self::getTable()->newEntities($data);
//        debug($entities);die;
        self::getTable()->saveManyOrFail($entities);
        return $entities;
    }
}
