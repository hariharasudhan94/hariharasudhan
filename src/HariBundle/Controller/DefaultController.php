<?php

namespace HariBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HariBundle:Default:index.html.twig');
    }
}
