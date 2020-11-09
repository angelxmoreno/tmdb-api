<?php
declare(strict_types=1);

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\Query;
use Cake\ORM\Table;

/**
 * ApiPaginator component
 */
class ApiPaginatorComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * @param Table|string|Query|null $object Table to paginate
     * (e.g: Table instance, 'TableName' or a Query object)
     * @param array $settings The settings/configuration used for pagination.
     * @return array
     */
    public function paginate($object = null, array $settings = [])
    {
        $items = $this->getController()->paginate($object, $settings);
        $pagination = $this->getPaginationParams();

        return compact('items', 'pagination');
    }

    /**
     * @return array
     */
    protected function getPaginationParams(): array
    {
        $aliasedParams = $this->getController()->Paginator->getPagingParams();
        $params = array_pop($aliasedParams);

        return [
            'current_page' => $params['page'],
            'current_item_count' => $params['current'],

            'has_next_page' => $params['nextPage'],
            'has_prev_page' => $params['prevPage'],

            'total_pages' => $params['pageCount'],
            'total_items_count' => $params['count'],

            'limit' => $params['perPage'] ?: $this->getController()->Paginator->getConfig('limit')
        ];
    }

}
