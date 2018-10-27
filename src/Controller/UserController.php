<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class UsersController extends AbstractController
{
    /**
     * @Route("/users")
     */
    public function index()
    {
        return $this->json(array('username' => 'jane.doe'));
    }
}