<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class UserRegisterService
{
    public function create(Request $request): User
    {
        return new User('','');
    }
}
