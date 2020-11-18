<?php

namespace App\Api\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use App\Entity\User;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        /** @var User $user */
        $user = $event->getUser();
        $payload = $event->getData();
        $payload['id'] = $user->getId();
        unset($payload['roles']);

        $event->setData($payload);
    }
}
