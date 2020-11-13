<?php

namespace App\Api\Action\User;

use App\Service\User\UserRegisterService;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;

class Register
{
    protected UserRegisterService $UserRegisterService;

    public function __construct(UserRegisterService $UserRegisterService)
    {
        $this->UserRegisterService = $UserRegisterService;
    }

    public function __invoke(Request $request): User
    {
        return $this->UserRegisterService->create($request);
    }
}
