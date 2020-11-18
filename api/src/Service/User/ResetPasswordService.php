<?php

namespace App\Service\User;

use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Request\RequestService;
use App\Entity\User;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ResetPasswordService
{
    protected UserRepository $userRepository;

    protected EncoderService $encoderService;

    public function __construct(UserRepository $userRepository, EncoderService $encoderService)
    {
        
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function reset(Request $request): User
    {
        $userId = RequestService::getField($request, 'userId');
        $resetPasswordToken = RequestService::getField($request, 'resetPasswordToken');
        $password = RequestService::getField($request, 'password');

        $user = $this->userRepository->findOneByIdAndResetPasswordToken($userId, $resetPasswordToken);
        $user->setPassword($this->encoderService->generateEncodedPassword($user, $password));
        $user->setResetPasswordToken(null);

        $this->userRepository->save($user);

        return $user;
    }
}
