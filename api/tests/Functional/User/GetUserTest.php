<?php

namespace App\Functional\User;

use App\Tests\Functional\User\UserTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetUserTest extends UserTestBase
{
     public function testGetUser(): void
     {
        $aquilesId = $this->getAquilesId();
        
        self::$aquiles->request('GET', \sprintf('%s/%s', $this->endpoint, $aquilesId));
        $response = self::$aquiles->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_OK, $response->getStatusCode());
        $this->assertEquals($aquilesId, $responseData['id']);
     }

     public function testGetAnotherUsersData()
     {
        $aquilesId = $this->getAquilesId();
        
        self::$hector->request('GET', \sprintf('%s/%s', $this->endpoint, $aquilesId));
        $response = self::$hector->getResponse();

        $this->assertEquals(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
     }
}
