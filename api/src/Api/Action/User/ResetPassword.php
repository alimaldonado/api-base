<?php

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\Request\RequestService;
use App\Service\User\ResetPasswordService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

class ResetPassword
{
    protected ResetPasswordService $resetPasswordService;

    public function __construct(ResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request, string $id): User
    {
        return $this->resetPasswordService->reset(
            $id,
            RequestService::getField($request, 'resetPasswordToken'),
            RequestService::getField($request, 'password'),
        );
    }
}
