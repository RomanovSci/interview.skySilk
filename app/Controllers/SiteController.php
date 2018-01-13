<?php

namespace App\Controllers;

use \Twig_Environment as Twig;

class SiteController
{
    protected $twig;

    /**
     * SiteController constructor.
     *
     * @param Twig $twig
     */
    public function __construct(Twig $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Render main page
     *
     * @return string
     */
    public function index()
    {
        return $this->twig->render('index.twig');
    }
}