<?php

namespace Mailer\Service\Mailer;

use Mailer\Templating\TwigTemplate;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class MailerService
{
    private const TEMPLATE_SUBJECT_MAP = [
        TwigTemplate::USER_REGISTER => 'Bienvenido(a)',
    ];
    
    protected MailerInterface $mailer;

    protected Environment $engine;

    protected LoggerInterface $logger;

    protected string $mailerDefaultSender;

    public function __construct(MailerInterface $mailer, Environment $engine, LoggerInterface $logger, string $mailerDefaultSender)
    {

        $this->mailer = $mailer;
        $this->environment = $engine;
        $this->logger = $logger;
        $this->mailerDefaultSender = $mailerDefaultSender;
    }

    /**
     * @throws \Exception
     */
    public function send(string $receiver, string $template, array $payload): void 
    {
        $email = (new Email())
            ->from($this->mailerDefaultSender)
            ->to($receiver)
            ->subject(self::TEMPLATE_SUBJECT_MAP[$template])
            ->html($this->engine->render($template, $payload));

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $ex) {
            $this->logger->error(\sprintf('Error sending email: %s', $ex->getMessage()));
        }
    }
}
