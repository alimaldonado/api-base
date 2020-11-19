<?php

namespace App\Tests\Functional;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Hautelook\AliceBundle\PhpUnit\RecreateDatabaseTrait;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TestBase extends WebTestCase
{
    use FixturesTrait;
    use RecreateDatabaseTrait;

    protected static ?KernelBrowser $client = null;
    protected static ?KernelBrowser $aquiles = null;
    protected static ?KernelBrowser $hector = null;
    protected static ?KernelBrowser $menelao = null;

    protected function setup()
    {
        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameters([
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/ld+json',
            ]);
        }

        if (null === self::$aquiles) {
            self::$aquiles = clone self::$client;
            $this->createAuthenticatedUser(self::$aquiles, 'aquiles@api.com');
        }
        if (null === self::$hector) {
            self::$hector = clone self::$client;
            $this->createAuthenticatedUser(self::$hector, 'hector@api.com');
        }

        if (null === self::$menelao) {
            self::$menelao = clone self::$client;
            $this->createAuthenticatedUser(self::$menelao, 'menelao@api.com');
        }
    }

    private function createAuthenticatedUser(KernelBrowser &$client, string $email): void
    {
        $user = $this
            ->getContainer()
            ->get('App\Repository\UserRepository')
            ->findOneByEmailOrFail($email);
        $token = $this
            ->getContainer()
            ->get('Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface')
            ->create($user);
        $client->setServerParameters([
            'HTTP_Authorization' => \sprintf('Bearer %s', $token),
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/ld+json',
        ]);
    }

    protected function getResponseData(Response $response): array
    {
        return \json_decode($response->getContent(), true);
    }

    protected function initDbConnection(): Connection
    {
        return $this
            ->getContainer()
            ->get('doctrine')
            ->getConnection();
    }

    /**
     * @return false|mixed
     *
     * @throws DBALException
     */
    protected function getAquilesId()
    {
        return $this->initDbConnection()->query('SELECT id FROM users WHERE email = "aquiles@api.com"')->fetchColumn(0);
    }

    /**
     * @return false|mixed
     *
     * @throws DBALException
     */
    protected function getHectorId()
    {
        return $this->initDbConnection()->query('SELECT id FROM users WHERE email = "hector@api.com"')->fetchColumn(0);
    }

    /**
     * @return false|mixed
     *
     * @throws DBALException
     */
    protected function getMenelaoId()
    {
        return $this->initDbConnection()->query('SELECT id FROM users WHERE email = "menelao@api.com"')->fetchColumn(0);
    }
}
