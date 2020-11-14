<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;

/**
 * Class BaseCommand
 * @package App\Command
 */
abstract class BaseCommand extends Command
{

    /**
     * @var ConsoleIo
     */
    protected $io;

    /**
     * @var Arguments
     */
    protected $args;

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

    /**
     * @return mixed
     */
    abstract protected function main();
}
