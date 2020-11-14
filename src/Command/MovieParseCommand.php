<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Table\MoviesTable;
use App\Service\Tmdb\Builders\ReviewBuilder;
use App\Service\Tmdb\TmdbService;
use Cake\Console\ConsoleOptionParser;

/**
 * MovieParse command.
 *
 * @property-read MoviesTable $Movies
 */
class MovieParseCommand extends BaseCommand
{
    const MOVIE_ID = 'movie_id';
    /**
     * @var TmdbService
     */
    protected $Tmdb;

    /**
     * Hook method invoked by CakePHP when a command is about to be executed.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Movies');
        $this->Tmdb = new TmdbService();
    }

    protected function main()
    {
        $movie_id = (int)$this->args->getArgument(self::MOVIE_ID);
        $this->io->info("Fetching data for movie id $movie_id");
        try {
            $movie = $this->Tmdb->getMovie($movie_id);
            $this->getMovieReviews($movie_id);
            $this->io->info(sprintf(
                'Saved movie "%s"',
                $movie->title
            ));
        } catch (\Exception $e) {
            $this->io->hr();
            $this->io->error(sprintf(
                'Unable to save movie with id %s because of "%s"',
                $movie_id,
                $e->getMessage()
            ));
            pr($e->getTraceAsString());
            $this->io->hr();
        }
    }

    /**
     * @param int $movie_id
     * @param int $page
     * @throws \Exception
     */
    protected function getMovieReviews(int $movie_id, int $page = 1)
    {
        $this->io->info('Getting movie reviews page ' . $page);
        $reviews = $this->Tmdb->getMovieReviews($movie_id);
        $total_pages = $reviews['total_pages'];
        $this->io->info('Savings movie reviews page ' . $page . ' of ' . $total_pages);

        ReviewBuilder::buildFromRaw($reviews);
        if ($total_pages > $page) {
            $this->getMovieReviews($movie_id, $page + 1);
        }
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @param ConsoleOptionParser $parser
     * @return ConsoleOptionParser
     */
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);
        $parser->addArgument(self::MOVIE_ID, [
            'help' => 'The movie id to parse',
            'required' => true,
        ]);
        return $parser;
    }
}
