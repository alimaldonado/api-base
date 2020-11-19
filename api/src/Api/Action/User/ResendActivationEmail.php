<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Service\Request\RequestService;
use App\Service\User\ResendActivationEmailService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ResendActivationEmail
{
    protected ResendActivationEmailService $activateEmailService;

    public function __construct(ResendActivationEmailService $activateEmailService)
    {
        $this->activateEmailService = $activateEmailService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->activateEmailService->resend(
            RequestService::getField($request, 'email')
        );

        return new JsonResponse(['message' => 'mail sent']);
    }
}
