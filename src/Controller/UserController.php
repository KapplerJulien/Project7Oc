<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/users/{id}", name="show_user", methods={"GET"})
     */
    public function show(User $user, UserRepository $userRepository, SerializerInterface $serializer)
    {
        $company = $this->getUser();
        $user = $userRepository->findOneBy([
            'id' => $user->getId(),
            'company' => $company
        ]);
        $data = $serializer->serialize($user, 'json', [
            'groups' => ['show']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

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

    /**
     * @Route("/users", name="add_user", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $company = $this->getUser();
        $user->setCompany($company);
        $entityManager->persist($user);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'Add succeded'
        ];
        return new JsonResponse($data, 201);
    }

    /**
     * @Route("/users/{id}", name="delete_phone", methods={"DELETE"})
     */
    public function delete(User $user, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($user);
        $entityManager->flush();
        $data = [
            'status' => 204,
            'message' => 'Delete succeded'
        ];
        return new JsonResponse($data, 204);
    }
}
