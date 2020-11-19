<?php

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class RquestResetPasswordTest extends UserTestBase
{
    public function testRequestResetPassword(): void
    {
        $payload = [
            'email' => 'aquiles@api.com'
        ];

        self::$aquiles->request('POST', \sprintf('%s/request_reset_password', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }

    public function testRequestResetPasswordForNonExistingEmail(): void
    {
        $payload = [
            'email' => 'unknown@api.com'
        ];

        self::$aquiles->request('POST', \sprintf('%s/request_reset_password', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();

        $this->assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}
