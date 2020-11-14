<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\Table\ValidMoviesTable;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;

/**
 * MovieListSync command.
 *
 * @property ValidMoviesTable $ValidMovies
 */
class MovieListSyncCommand extends BaseCommand
{
    const LIMIT = 'limit';
    const DEFAULT_LIMIT = 100;
    protected $limit = self::DEFAULT_LIMIT;

    public function initialize()
    {
        parent::initialize();
        $this->loadModel(ValidMoviesTable::class);
    }

    /**
     * @param Arguments $args
     * @param ConsoleIo $io
     * @return int|void|null
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $this->limit = $args->hasArgument(self::LIMIT)
            ? (int)$args->getArgument(self::LIMIT)
            : self::DEFAULT_LIMIT;
        parent::execute($args, $io);
    }

    /**
     * Hook method for defining this command's option parser.
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    protected function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);
        return $parser->addArgument(self::LIMIT, [
            'help' => 'Number of movies to sync'
        ]);
    }

    /**
     * @return mixed
     */
    protected function main()
    {
        $start_time = microtime(true);
        $this->io->info(sprintf('Fetching %s movies to sync', number_format($this->limit)));
        $movies = $this->ValidMovies->findMissingSyncs(1, $this->limit);
        foreach ($movies as $i => $movie) {
            $this->io->hr();
            $this->io->info(sprintf('Fetching movie %s of %s', number_format($i + 1), number_format($this->limit)));
            $this->executeCommand(MovieParseCommand::class, [$movie->id]);
        }
        $this->io->hr();

        $end_time = microtime(true);
        $execution_time = ($end_time - $start_time);
        $this->io->info(" Execution time of script = " . $execution_time . " sec");
    }

}
