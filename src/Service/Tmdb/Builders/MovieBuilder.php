<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Entity\Movie;

/**
 * Class MovieBuilder
 * @package App\Service\Tmdb\Builders
 */
class MovieBuilder extends BuilderBase
{
    const TABLE_NAME = 'Movies';

    /**
     * @param array $data
     * @return \App\Model\Entity\Movie
     * @throws \Exception
     */
    public static function buildFromRaw(array $data): Movie
    {
        /** @var Movie $movie */
        $movie = self::getTable()->newEntity($data, ['associated' => []]);
        $movie->keywords = KeywordBuilder::buildFromRaw($data);
        $movie->genres = GenreBuilder::buildFromRaw($data);
        self::getTable()->saveOrFail($movie);
        return $movie;
    }
}
