<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use Cake\Utility\Hash;

/**
 * Class KeywordBuilder
 * @package App\Service\Tmdb\Builders
 */
class KeywordBuilder extends BuilderBase
{
    const TABLE_NAME = 'Keywords';

    /**
     * @param array $data
     * @return \App\Model\Entity\Keyword[]
     * @throws \Exception
     */
    public static function buildFromRaw(array $data): array
    {
        $keyword_data = Hash::get($data, 'keywords.keywords');
        return self::save($keyword_data);
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Keyword[]
     * @throws \Exception
     */
    protected static function save(array $data): array
    {
        $entities = self::getTable()->newEntities($data);
        self::getTable()->saveManyOrFail($entities);
        return $entities;
    }
}
