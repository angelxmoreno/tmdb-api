<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use Cake\Utility\Hash;

/**
 * Class GenreBuilder
 * @package App\Service\Tmdb\Builders
 */
class GenreBuilder extends BuilderBase
{
    const TABLE_NAME = 'Genres';

    /**
     * @param array $data
     * @return \App\Model\Entity\Genre[]
     * @throws \Exception
     */
    public static function buildFromRaw(array $data): array
    {
        $genre_data = Hash::get($data, 'genres');
        return self::save($genre_data);
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Genre[]
     * @throws \Exception
     */
    protected static function save(array $data): array
    {
        $entities = self::getTable()->newEntities($data);
        self::getTable()->saveManyOrFail($entities);
        return $entities;
    }
}
