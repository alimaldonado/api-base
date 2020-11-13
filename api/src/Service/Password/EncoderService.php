<?php
declare(strict_types=1);

namespace App\Service\Password;

use App\Exception\Password\PasswordException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

class EncoderService
{
    private const MINIMUM_LENGHT = 6;

    private UserPasswordEncoderInterface $userPasswordEncoderInterface;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {   
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }

    public function generateEncodedPassword(UserInterface $user, string $password)
    {
        if (self::MINIMUM_LENGHT > \strlen($password)) {
            throw PasswordException::invalidLenght();
        }
        return $this->userPasswordEncoderInterface->encodePassword($user, $password);
    }

    public function isValidPassword(User $user, string $oldPassword): bool
    {
        return $this->userPasswordEncoderInterface->isPasswordValid($user, $oldPassword);
    }
}
