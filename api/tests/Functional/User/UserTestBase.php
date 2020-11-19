<?php

namespace App\Tests\Functional\User;

use App\Tests\Functional\TestBase;

class UserTestBase extends TestBase
{
    protected string $endpoint;

    protected function setup()
    {
        parent::setup();

        $this->endpoint = '/api/v1/users';
    }
}
