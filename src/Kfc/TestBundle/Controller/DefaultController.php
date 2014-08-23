<?php

namespace Kfc\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KfcTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
