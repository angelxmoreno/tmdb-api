<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Table\MoviesTable;
use App\Service\Tmdb\TmdbService;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * MovieParse command.
 *
 * @property-read MoviesTable $Movies
 */
class MovieParseCommand extends Command
{
    const MOVIE_ID = 'movie_id';
    /**
     * @var TmdbService
     */
    protected $Tmdb;

    /**
     * @var ConsoleIo
     */
    protected $io;

    /**
     * @var Arguments
     */
    protected $args;

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

    /**
     * @param Arguments $args
     * @param ConsoleIo $io
     * @return int|void|null
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->io = $io;
        $this->args = $args;
        $this->main();
    }

    protected function main()
    {
        $movie_id = $this->args->getArgument(self::MOVIE_ID);
        $this->io->info("Fetching data for movie id $movie_id");
        try {
            $movie = $this->Tmdb->getMovie($movie_id);

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
