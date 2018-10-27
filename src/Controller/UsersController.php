<?php

namespace App\Controller;

use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UsersController extends AbstractController
{
    /**
     * @Route("/users")
     */
    public function index(UserServiceInterface $userService, Request $request)
    {

        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset', 0);
        $filters = $this->getFilters($request);

        $users = $userService->getUsers($offset, $limit, $filters);
        return $this->json($users);
    }

    protected function getFilters(Request $request): array
    {
        $request->query->remove('limit');
        $request->query->remove('offset');
        return $request->query->all();
    }
}