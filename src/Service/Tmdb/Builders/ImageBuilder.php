<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Entity\Movie;
use Cake\Utility\Hash;

/**
 * Class ImageBuilder
 * @package App\Service\Tmdb\Builders
 */
class ImageBuilder extends BuilderBase
{
    const TABLE_NAME = 'Images';

    /**
     * @param Movie $movie
     * @param array $data
     * @param string $path
     * @param string $association
     * @return \App\Model\Entity\Image[]
     * @throws \Exception
     */
    public static function buildFromRaw(Movie $movie, array $data, string $path, string $association): array
    {
        $image_data = Hash::get($data, $path);
        $image_data = \collection($image_data)->map(function ($row) use ($movie) {
            $row['foreign_uid'] = $movie->id;
            return $row;
        })->toArray();
        return self::save($image_data, $association);
    }

    /**
     * @param array $data
     * @param string $association
     * @return \App\Model\Entity\Image[]
     * @throws \Exception
     */
    protected static function save(array $data, string $association): array
    {
        $entities = self::getTable($association)->newEntities($data);
        self::getTable($association)->saveManyOrFail($entities);
        return $entities;
    }
}
