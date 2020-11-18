<?php

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\User\ActivateAccountService;
use Symfony\Component\HttpFoundation\Request;

class ActivateAccount
{
    protected ActivateAccountService $activateAccountService;

    public function __construct(ActivateAccountService $activateAccountService)
    {
        $this->activateAccountService = $activateAccountService;
    }

    public function __invoke(Request $request, string $id) : User
    {
        return $this->activateAccountService->activate($request, $id);
    }
}