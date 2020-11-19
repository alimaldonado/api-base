<?php

namespace App\Tests\Functional\User;

use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginActionTest extends UserTestBase
{
    public function testLogin(): void
    {
        $payload = [
            'username' => 'aquiles@api.com',
            'password' => 'password'
        ];

        self::$aquiles->request('POST', \sprintf('%s/login_check', $this->endpoint),[], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertInstanceOf(JWTAuthenticationSuccessResponse::class, $response);
    }

    public function testInvalidCredentials(): void
    {
        $payload = [
            'username' => 'aquiles@api.com',
            'password' => 'invalid_password'
        ];

        self::$aquiles->request('POST', \sprintf('%s/login_check', $this->endpoint),[], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();

        $this->assertEquals(JsonResponse::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $response);
    }
}
