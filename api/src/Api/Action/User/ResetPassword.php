<?php

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\User\ResetPasswordService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

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
    public function __invoke(Request $request): User
    {
        return $this->resetPasswordService->reset($request);
    }
}