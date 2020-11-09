<?php
declare(strict_types=1);

namespace App\Shell;

use App\Service\Pusher\PusherService;
use Cake\Console\Shell;
use Pusher\PusherException;

/**
 * Pusher shell command.
 */
class PusherShell extends Shell
{
    /**
     * @var PusherService
     */
    protected $Pusher;

    /**
     * @throws PusherException
     */
    public function initialize()
    {
        parent::initialize();
        $this->Pusher = PusherService::instance();
    }

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \Cake\Console\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        $parser = parent::getOptionParser();
        $parser->addSubcommand('channels', [
            'help' => 'List channels application that have active subscriptions',
        ]);
        $parser->addSubcommand('channel', [
            'help' => 'Show the state of an individual channel',
        ]);
        $parser->addSubcommand('send', [
            'help' => 'Show the state of an individual channel',
        ]);
        $parser->addSubcommand('sendToUser', [
            'help' => 'send and event to a user by user_id',
        ]);
        return $parser;
    }

    /**
     * main() method.
     *
     * @return void Success or error code.
     */
    public function main()
    {
        $this->out($this->OptionParser->help());
    }

    /**
     * @throws PusherException
     */
    public function channels()
    {
        $response = $this->Pusher->get('/channels');
        if ($response['status'] == 200) {
            $this->out(print_r($response['result']['channels'], true));
        } else {
            $this->err(print_r($response, true));
        }
    }


    /**
     * @param string|null $name
     * @throws PusherException
     */
    public function channel(string $name = null)
    {
        if (!$name) {
            $this->err('Channel name is required');
        }
        $response = $this->Pusher->get('/channels/' . $name);
        if ($response['status'] == 200) {
            $this->out(print_r($response['result'], true));
        } else {
            $this->err(print_r($response, true));
        }
    }

    /**
     * @param string $channel
     * @param string $event
     * @param string $data
     * @throws PusherException
     */
    public function send(string $channel, string $event, string $data)
    {
        $response = $this->Pusher->trigger($channel, $event, $data, null, true, true);
        $this->out(print_r($response, true));
    }

    /**
     * @param string $user_id
     * @param string $event
     * @param string $data
     * @throws PusherException
     */
    public function sendToUser(string $user_id, string $event, string $data)
    {
        $payload = json_decode($data, true);
        if (!$payload) {
            throw new \UnexpectedValueException('Data cannot be decoded');
        }

        $response = $this->Pusher->sendToUserById($user_id, $event, $payload);
        $this->out(print_r($response, true));
    }
}
