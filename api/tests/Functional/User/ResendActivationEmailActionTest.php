<?php

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResendActivationEmailActionTest extends UserTestBase
{
    public function testResendActivationEmail(): void
    {
        $payload = [
            'email' => 'menelao@api.com'
        ];

        self::$menelao->request('POST', \sprintf('%s/resend_activation_email', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$menelao->getResponse();

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    public function testResendActivationEmailForActiveUser(): void
    {
        $payload = [
            'email' => 'hector@api.com'
        ];

        self::$hector->request('POST', \sprintf('%s/resend_activation_email', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$hector->getResponse();

        $this->assertEquals(JsonResponse::HTTP_CONFLICT, $response->getStatusCode());
    }
}
