<?php

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class ChangePasswordActionTest extends UserTestBase
{
    public function testChangePassword(): void
    {
        $payload = [
            'oldPassword' => 'password',
            'newPassword' => 'new_password'
        ];

        self::$aquiles->request('PUT', \sprintf('%s/%s/change_password', $this->endpoint, $this->getAquilesId()), [], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();
        
        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
    }
    public function testChangePasswordWithInvalidOldPassword(): void
    {
        $payload = [
            'oldPassword' => 'invalid_password',
            'newPassword' => 'new_password'
        ];

        self::$aquiles->request('PUT', \sprintf('%s/%s/change_password', $this->endpoint, $this->getAquilesId()), [], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();
        
        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
