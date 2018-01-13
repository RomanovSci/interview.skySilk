<?php

namespace App\Services;

class MailService
{
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
            $message = "http://localhost:3000/activation?mail=$to&code=$code";
            return mail($to, 'Account activation', $message);
        } catch (\Exception $e) {
            return false;
        }
    }
}