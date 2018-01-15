<?php

namespace App\Services;

use Monolog\Handler\StreamHandler;
use PHPMailer\PHPMailer\PHPMailer;
use Monolog\Logger;

class MailService
{
    protected $mailer;
    protected $logger;

    public function __construct(PHPMailer $mailer, Logger $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * Send activation code to user
     *
     * @param string $to
     * @param string $code
     * @return bool
     */
    public function sendActivationCode($to, $code): bool
    {
        try {
            if (getenv('ENV') === 'development') {
                $this->logger->pushHandler(new StreamHandler(__DIR__.'/../../storage/logger/application.log'));
                $this->logger->info('http://'.$_SERVER['HTTP_HOST']."/activation?mail=$to&code=$code");

                return true;
            }

            // TODO: Implement mail sending for production environment
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}