<?php

namespace App\Functional\User;

use App\Tests\Functional\User\UserTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;

class DeleteUserTest extends UserTestBase
{
    public function testDeleteUser(): void
    {
        self::$aquiles->request('DELETE', \sprintf('%s/%s', $this->endpoint, $this->getAquilesId()));
        $response = self::$aquiles->getResponse();
        $this->assertEquals(JsonResponse::HTTP_NO_CONTENT, $response->getStatusCode());
    }
    public function testDeleteAnotherUser(): void
    {
        self::$menelao->request('DELETE', \sprintf('%s/%s', $this->endpoint, $this->getAquilesId()));
        $response = self::$menelao->getResponse();
        $this->assertEquals(JsonResponse::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
