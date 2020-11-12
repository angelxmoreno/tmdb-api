<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Entity\Movie;
use Cake\Utility\Hash;

/**
 * Class PersonBuilder
 * @package App\Service\Tmdb\Builders
 */
class PersonBuilder extends BuilderBase
{
    const TABLE_NAME = 'People';

    /**
     * @param Movie $movie
     * @param array $data
     * @param string $path
     * @param string $association
     * @return \App\Model\Entity\Person[]
     * @throws \Exception
     */
    public static function buildFromRaw(Movie $movie, array $data, string $path, string $association): array
    {
        $person_data = Hash::get($data, $path);
        $person_data = \collection($person_data)->map(function ($row) use ($movie) {
            $row['movie_id'] = $movie->id;
            return $row;
        })->toArray();
        self::save($person_data);
        return self::save($person_data, $association);
    }

    /**
     * @param array $data
     * @param string|null $association
     * @return \App\Model\Entity\Person[]
     * @throws \Exception
     */
    protected static function save(array $data, string $association = null): array
    {
        $entities = self::getTable($association)->newEntities($data);
        self::getTable($association)->saveManyOrFail($entities);
        return $entities;
    }
}
