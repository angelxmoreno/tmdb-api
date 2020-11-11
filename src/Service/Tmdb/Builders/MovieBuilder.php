<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Entity\Company;
use App\Model\Entity\Movie;
use App\Model\Table\MoviesCompaniesTable;

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

        $production_companies = CompanyBuilder::buildFromRaw($data);
        self::linkProductionCompanies($movie, $production_companies);
        return $movie;
    }

    /**
     * @param Movie $movie
     * @param Company[] $companies
     * @return void
     */
    protected static function linkProductionCompanies(Movie $movie, array $companies)
    {
        foreach ($companies as $company) {
            $data = [
                'movie_id' => $movie->id,
                'company_id' => $company->id,
                'type' => MoviesCompaniesTable::TYPE_PRODUCTION
            ];
            self::getTable('MoviesCompanies')->findOrCreate($data);
        }
    }
}
