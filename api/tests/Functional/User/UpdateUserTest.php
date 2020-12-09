<?php

namespace App\Functional\User;

use App\Tests\Functional\User\UserTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class UpdateUserTest extends UserTestBase
{
    public function testUpdatedUser(): void
    {
        $payload = ['name' => 'Aquiles New'];
        self::$aquiles->request('PUT', \sprintf('%s/%s', $this->endpoint, $this->getAquilesId()), [], [], [], \json_encode($payload));
        
        $response = self::$aquiles->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($payload['name'], $responseData['name']);
    }
    public function testUpdateAnotherUser(): void
    {
        $payload = ['name' => 'Aquiles New'];

        self::$menelao->request('PUT', \sprintf('%s/%s', $this->endpoint, $this->getAquilesId()), [], [], [], \json_encode($payload));
        
        $response = self::$menelao->getResponse();

        $this->assertEquals(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
