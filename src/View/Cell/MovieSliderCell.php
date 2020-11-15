<?php
declare(strict_types=1);

namespace App\View\Cell;

use App\Model\Table\MoviesTable;
use Cake\View\Cell;

/**
 * MovieSlider cell
 *
 * @property MoviesTable $Movies
 */
class MovieSliderCell extends Cell
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
    public function display(int $limit = 3)
    {
        $movies = $this->Movies
            ->find()
            ->orderDesc('popularity')
            ->whereNotNull('backdrop_path')
            ->limit($limit)
            ->all();
        $this->set(compact('movies'));
    }
}
