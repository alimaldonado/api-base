<?php

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\User\ChangePasswordService;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class ChangePassword
{
    protected ChangePasswordService $changePasswordService;

    public function __construct(ChangePasswordService $changePasswordService)
    {
        $this->changePasswordService = $changePasswordService;
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request, User $user): User
    {
        return $this->changePasswordService->changePassword($request, $user);
    }
}
