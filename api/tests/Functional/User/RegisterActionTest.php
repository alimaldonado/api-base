<?php

namespace App\Tests\Functional\User;

use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterActionTest extends UserTestBase
{
    public function testRegister(): void
    {
        $payload = [
            "name" => "Dewie",
            "email" => "dewie@api.com",
            "password" => "a_strong_password"
        ];    

        self::$client->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        $this->assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $this->assertEquals($payload['email'], $responseData['email']);
    }

    public function testRegisterWithMissingParameters(): void    
    {
        $payload = [
            "name" => "Dewie",
            "password" => "a_strong_password"
        ];    

        self::$client->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
    public function testRegisteredWithInvalidPassword(): void
    {
        $payload = [
            "name" => "Dewie",
            "email" => "dewie@api.com",
            "password" => "small"
        ];    

        self::$client->request('POST', \sprintf('%s/register', $this->endpoint), [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();

        $this->assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
    }
}
