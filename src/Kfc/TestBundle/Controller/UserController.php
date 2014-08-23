<?php
/**
 * Created by PhpStorm.
 * User: haxor
 * Date: 23/08/14
 * Time: 15:24
 */

namespace Kfc\TestBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{
    public function allAction()
    {

        $users=$this->getDoctrine()->getRepository('KfcTestBundle:User')->findAll();
        $view=$this->view($users);
        $view->setFormat('json');
        return $this->handleView($view);
    }
    public function getAction()
    {

    }

} 