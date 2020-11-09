<?php

namespace App\Command;

use Cake\Chronos\Chronos;
use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Cake\Console\ConsoleOptionParser;
use Cake\Core\Configure;

/**
 * MovieListDownload command.
 */
class MovieListDownloadCommand extends Command
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

        $api_key = Configure::read('Tmdb.api_key');
        $now = Chronos::now()->subDays(1);
        $date = $now->format('m_d_Y');
        $file_json = "movie_ids_{$date}.json";
        $file_zip = $file_json . '.gz';
        $url = "http://files.tmdb.org/p/exports/{$file_zip}";
        $path = MOVIE_LIST_DIR . $now->format('Ymd') . DS;
        if (is_dir($path)) {
            return $io->info("Path {$path} already exists");
        }
        $io->info("Creating path {$path}");
        mkdir($path);
        $io->info("Created path {$path}");

        $io->info("Downloading {$url}");
        $data = file_get_contents("{$url}?api_key={$api_key}");
        $unzipped = file_get_contents('compress.zlib://data:who/cares;base64,' . base64_encode($data));
        file_put_contents($path . $file_json, $unzipped);
        $io->info("Saved {$path}{$file_json}");

        echo PHP_EOL;
    }
}
