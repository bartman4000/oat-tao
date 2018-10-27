<?php

namespace App\Controller;

use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/user/{id}", name="user_is", requirements={"id"="\d+"})
     */
    public function index($id, UserServiceInterface $userService)
    {
        $user = $userService->getUser($id);
        return $this->json($user);
    }
}