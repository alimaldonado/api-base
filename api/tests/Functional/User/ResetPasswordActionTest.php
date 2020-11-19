<?php

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResetPasswordActionTest extends UserTestBase
{
    public function testResetPassword(): void
    {
        $aquilesId = $this->getAquilesId();
        $payload = [
            "resetPasswordToken" => "123456",
            "password" => "new_strong_password"
        ];

        self::$aquiles->request('PUT', \sprintf('%s/%s/reset_password', $this->endpoint, $aquilesId), [], [], [], \json_encode($payload));

        $response = self::$aquiles->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($aquilesId, $responseData['id']);
    }
}
