<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use Cake\Utility\Hash;

/**
 * Class CompanyBuilder
 * @package App\Service\Tmdb\Builders
 */
class CompanyBuilder extends BuilderBase
{
    const TABLE_NAME = 'Companies';

    /**
     * @param array $data
     * @return \App\Model\Entity\Company[]
     * @throws \Exception
     */
    public static function buildFromRaw(array $data): array
    {
        $company_data = Hash::get($data, 'production_companies');
        return self::save($company_data);
    }

    /**
     * @param array $data
     * @return \App\Model\Entity\Company[]
     * @throws \Exception
     */
    protected static function save(array $data): array
    {
        $entities = self::getTable()->newEntities($data);
        self::getTable()->saveManyOrFail($entities);
        return self::getTable()->saveManyOrFail($entities);
    }
}
