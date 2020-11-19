<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;

class ActivateAccountService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function activate(string $token, string $id): User
    {
        $user = $this->userRepository->findOneInactiveByIdAndTokenOrFail(
            $id,
            $token
        );

        $user->setActive(true);
        $user->setToken(null);

        $this->userRepository->save($user);

        return $user;
    }
}
