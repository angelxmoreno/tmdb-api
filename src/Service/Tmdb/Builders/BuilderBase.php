<?php
declare(strict_types=1);

namespace App\Service\Tmdb\Builders;

use App\Model\Table\MoviesTable;
use Cake\ORM\TableRegistry;

/**
 * Class BuilderBase
 * @package App\Service\Tmdb\Builders
 */
abstract class BuilderBase
{
    const TABLE_NAME = '';
    protected static $tables = [];

    /**
     * @return MoviesTable
     */
    protected static function getMoviesTable(): MoviesTable
    {
        if (!isset(self::$tables['Movies'])) {
            self::$tables['Movies'] = TableRegistry::getTableLocator()->get('Movies');
        }
        return self::$tables['Movies'];
    }

    /**
     * @param string|null $table_name
     * @return \Cake\ORM\Table
     */
    protected static function getTable(string $table_name = null)
    {
        $table_name = $table_name ?? static::TABLE_NAME;
        if (!isset(self::$tables[$table_name])) {
            self::$tables[$table_name] = TableRegistry::getTableLocator()->get($table_name);
        }
        return self::$tables[$table_name];
    }

}
