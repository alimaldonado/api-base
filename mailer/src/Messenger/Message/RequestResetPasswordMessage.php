<?php

namespace Mailer\Messenger\Message;

class RequestResetPasswordMessage
{
    protected string $id;

    protected string $email;

    protected string $resetPasswordToken;

    public function __construct(string $id, string $email, string $resetPasswordToken)
    {
        
        $this->id = $id;
        $this->email = $email;
        $this->resetPasswordToken = $resetPasswordToken;
    }
 
    public function getId()
    {
        return $this->id;
    }
 
    public function getEmail()
    {
        return $this->email;
    }
 
    public function getResetPasswordToken()
    {
        return $this->resetPasswordToken;
    }
}
