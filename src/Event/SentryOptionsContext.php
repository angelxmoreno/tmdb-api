<?php
declare(strict_types=1);

namespace App\Event;

use Cake\Event\Event;
use Cake\Event\EventListenerInterface;
use Cake\Http\ServerRequest;
use Cake\Http\ServerRequestFactory;
use Sentry\State\Scope;
use function Sentry\configureScope as sentryConfigureScope;

/**
 * Class SentryOptionsContext
 * @package App\Event
 */
class SentryOptionsContext implements EventListenerInterface
{
    static $user = [];

    /**
     * @return array|string[]
     */
    public function implementedEvents()
    {
        return [
            'CakeSentry.Client.beforeCapture' => 'setServerContext',
            'Auth.afterIdentify' => 'setAuth',
        ];
    }

    /**
     * @param Event $event
     */
    public function setAuth(Event $event)
    {
        $user = $event->getData(0);
        self::$user = (array)$user;
    }

    /**
     * @param Event $event
     */
    public function setServerContext(Event $event)
    {
        if (PHP_SAPI !== 'cli') {
            /** @var ServerRequest $request */
            $request = $event->getData('request') ?? ServerRequestFactory::fromGlobals();
            $request->trustProxy = true;

            sentryConfigureScope(function (Scope $scope) use ($request, $event) {
                $scope->setUser(array_merge([
                    'ip_address' => $request->clientIp()
                ], self::$user));
            });
        }
    }
}
