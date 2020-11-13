<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use Cake\Utility\Hash;

/**
 * Class ReviewBuilder
 * @package App\Service\Tmdb\Builders
 */
class ReviewBuilder extends BuilderBase
{
    const TABLE_NAME = 'Reviews';

    /**
     * @param array $data
     * @return \App\Model\Entity\Review[]
     * @throws \Exception
     */
    public static function buildFromRaw(array $data): array
    {
        $reviewers = Hash::extract($data, 'results.{n}.author_details');
        $reviews = Hash::get($data, 'results');
        self::saveReviewers($reviewers);
        return self::saveReviews($reviews);
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Reviewer[]
     * @throws \Exception
     */
    protected static function saveReviewers(array $data): array
    {
        $entities = self::getTable('Reviewers')->newEntities($data);
        self::getTable('Reviewers')->saveManyOrFail($entities);
        return $entities;
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Review[]
     * @throws \Exception
     */
    protected static function saveReviews(array $data): array
    {
        $entities = self::getTable()->newEntities($data);
        self::getTable()->saveManyOrFail($entities);
        return $entities;
    }
}
