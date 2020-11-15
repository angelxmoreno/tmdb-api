<?php
declare(strict_types=1);

namespace App\View\Cell;

use App\Model\Table\MoviesTable;
use Cake\View\Cell;

/**
 * MovieCards cell
 *
 * @property MoviesTable $Movies
 */
class MovieCardsCell extends Cell
{
    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
        $this->loadModel('Movies');
    }

    /**
     * Default display method.
     *
     * @param int $limit
     * @return void
     */
    public function display($limit = 5)
    {
        $movies = $this->Movies
            ->find()
            ->orderDesc('vote_count')
            ->whereNotNull('backdrop_path')
            ->limit($limit)
            ->all();
        $this->set(compact('movies'));
    }
}
