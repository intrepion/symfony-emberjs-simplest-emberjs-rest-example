<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/users", name="find-all-users")
     */
    public function findAllUsersAction()
    {
        return $this->render('AppBundle:Default:users.html.twig');
    }

    /**
     * @Route("/users/{id}", name="find-user")
     */
    public function findUserAction($id)
    {
        return $this->render('AppBundle:Default:user.html.twig');
    }


    /**
     * @Route("/messages", name="find-all-messages")
     */
    public function findAllMessagesAction()
    {
        return $this->render('AppBundle:Default:messages.html.twig');
    }
}
