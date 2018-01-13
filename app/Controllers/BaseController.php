<?php

namespace App\Controllers;

class BaseController
{
    /**
     * Unsuccess message response
     *
     * @param string $message
     * @return string
     */
    protected function unsuccess($message = '')
    {
        return json_encode([
            'success' => false,
            'message' => $message,
        ]);
    }

    /**
     * Redirect
     *
     * @param string $url
     * @return void
     */
    protected function redirect($url = '/')
    {
        header("Location: $url", true, 303);
    }
}