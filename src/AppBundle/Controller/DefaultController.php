<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AppUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();
        $repository = $manager->getRepository('AppBundle:AppUser');
        $appUsers = $repository->findAll();

        $appUsersArray = array(
            'users' => array_map(
                function ($appUser)
                {
                    $appUserMessages = $appUser->getMessage();
                    $appUserMessageIds = $appUserMessages->map(
                        function ($appUserMessage)
                        {
                            return $appUserMessage->getId();
                        }
                    )->toArray();

                    return array(
                        'id'          => $appUser->getId(),
                        'screen_name' => $appUser->getScreenName(),
                        'messages'    => $appUserMessageIds,
                    );
                },
                $appUsers
            )
        );

        return new JsonResponse($appUsersArray);
    }

    /**
     * @Route("/users/{appUser}", name="find-user")
     */
    public function findUserAction(AppUser $appUser)
    {
        $appUserMessages = $appUser->getMessage();
        $appUserMessageIds = $appUserMessages->map(
            function ($appUserMessage)
            {
                return $appUserMessage->getId();
            }
        )->toArray();
        $appUserArray = array(
            'id'          => $appUser->getId(),
            'screen_name' => $appUser->getScreenName(),
            'messages'    => $appUserMessageIds,
        );

        return new JsonResponse($appUserArray);
    }


    /**
     * @Route("/messages", name="find-all-messages")
     */
    public function findAllMessagesAction()
    {
        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();
        $repository = $manager->getRepository('AppBundle:Message');
        $messages = $repository->findAll();

        $messagesArray = array(
            'messages' => array_map(
                function ($message)
                {
                    return array(
                        'id'      => $message->getId(),
                        'text'    => $message->getText(),
                        'user_id' => $message->getAppUser()->getId(),
                    );
                },
                $messages
            )
        );

        return new JsonResponse($messagesArray);
    }
}
