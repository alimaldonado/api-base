<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Exception\User\UserIsActiveException;
use App\Repository\UserRepository;
use App\Service\Request\RequestService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Messenger\Message\UserRegisteredMessage;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use App\Messenger\Message\RoutingKey;

class ResendActivationEmailService
{
    protected UserRepository $userRepository;

    protected MessageBusInterface $messageBus;

    public function __construct(UserRepository $userRepository, MessageBusInterface $messageBus)
    {
        
        $this->userRepository = $userRepository;
        $this->messageBus = $messageBus;
    }

    public function resend(Request $request) : void
    {
        $email = RequestService::getField($request, 'email');
        $user = $this->userRepository->findOneByEmailOrFail($email);

        if ($user->isActive()) {
            throw UserIsActiveException::fromEmail($email);
        }
        
        $user->setToken(\sha1(\uniqid()));
        $this->userRepository->save($user);

        $this->messageBus->dispatch(
            new UserRegisteredMessage($user->getId(), $user->getName(), $user->getEmail(), $user->getToken()),
            [new AmqpStamp(RoutingKey::USER_QUEUE)]
        );
    }
}
