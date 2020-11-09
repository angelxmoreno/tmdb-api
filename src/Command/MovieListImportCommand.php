<?php

namespace App\Command;

use App\Model\Table\ValidMoviesTable;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Filesystem\Folder;
use Cake\ORM\TableRegistry;

/**
 * MovieListImport command.
 */
class MovieListImportCommand extends Command
{
    /**
     * Hook method for defining this command's option parser.
     *
     * @see https://book.cakephp.org/3.0/en/console-and-shells/commands.html#defining-arguments-and-options
     *
     * @param \Cake\Console\ConsoleOptionParser $parser The parser to be defined
     * @return \Cake\Console\ConsoleOptionParser The built parser.
     */
    public function buildOptionParser(ConsoleOptionParser $parser)
    {
        $parser = parent::buildOptionParser($parser);

        return $parser;
    }

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|int The exit code or null for success
     */
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $files = $this->getUnparsedFiles();
        $count = count($files);
        if ($count === 0) {
            return $io->info('No files to parse');
        }
        $io->info("Parsing $count files");
        foreach ($files as $file) {
            $io->info('Parsing file ' . $file);
            $this->parseFile($file, $io);
            $io->info('Completed parsing file ' . $file);
            unlink($file);
            $io->info("$file deleted");
        }

    }

    /**
     * @return string[]
     */
    protected function getUnparsedFiles(): array
    {
        $dir = new Folder(MOVIE_LIST_DIR);
        return $dir->findRecursive('.*\.json');
    }

    protected function parseFile(string $path, ConsoleIo $io)
    {
        /** @var ValidMoviesTable $table */
        $table = TableRegistry::getTableLocator()->get('ValidMovies');
        $handle = fopen($path, "r");
        while (($line = fgets($handle, 4096)) !== false) {
            $data = \GuzzleHttp\json_decode($line, true);
            $io->hr();
            $io->info('Saving ' . $data['original_title']);

            try {
                $table->upsertData($data);
                $io->info('Saved');
            } catch (\Throwable $e) {
                $io->warning('not saved: ' . $e->getMessage());
            }
        }
        fclose($handle);
    }
}
