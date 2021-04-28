<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/users/", name="list_user", methods={"GET"})
     */
    public function index(Request $request, UserRepository $userRepository, SerializerInterface $serializer): Response
    {
        $company = $this->getUser();
        $page = $request->query->get('page');
        if(is_null($page) || $page < 1) {
            $page = 1;
        }
        $limit = 5;
        // var_dump($company);
        $users = $userRepository->findAllUsers($page, $limit, $company);
        $data = $serializer->serialize($users, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }
}
