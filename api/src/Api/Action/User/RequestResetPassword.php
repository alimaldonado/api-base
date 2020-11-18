<?php

namespace App\Api\Action\User;

use App\Service\User\RequestResetPasswordService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;

class RequestResetPassword
{
    protected RequestResetPasswordService $resetPasswordService;

    public function __construct(RequestResetPasswordService $resetPasswordService)
    {
        $this->resetPasswordService = $resetPasswordService;
    }
    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $this->resetPasswordService->send($request);
        return new JsonResponse(["message" => "reset password email sent"]);
    }
}
