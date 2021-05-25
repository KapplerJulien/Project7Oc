<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security as Secu;
use OpenApi\Annotations as OA;

/**
 * @Route("/api")
 */
class PhoneController extends AbstractController
{
    /**
     * @Route("/phones/{id}", name="show_phone", methods={"GET"})
     * @OA\Response(
     *         response=200,
     *         description="Return details of one phone",
     *         @Model(type=Phone::class, groups={"show"})
     * )
     * @OA\Response(
     *         response=404,
     *         description="This phone don't exist"
     * )
     * @OA\Tag(name="Phone")
     * @Secu(name="Bearer")
     */
    public function show(Phone $phone, PhoneRepository $phoneRepository, SerializerInterface $serializer)
    {
        $phone = $phoneRepository->find($phone->getId());
        $data = $serializer->serialize($phone, 'json', [
            'groups' => ['show']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/phones/", name="list_phone", methods={"GET"})
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page",
     *     required=false,
     *     @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     *         response=200,
     *         description="Return an array of phones",
     *         @Model(type=Phone::class, groups={"list"})
     * )
     * @OA\Tag(name="Phone")
     * @Secu(name="Bearer")
     */
    public function index(Request $request, PhoneRepository $phoneRepository, SerializerInterface $serializer)
    {
        $page = $request->query->get('page');
        if(is_null($page) || $page < 1) {
            $page = 1;
        }
        $limit = 10;
        $phones = $phoneRepository->findAllPhones($page, $limit);
        // var_dump($phones);
        $data = $serializer->serialize($phones, 'json', [
            'groups' => ['list']
        ]);
        return new Response($data, 200, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * @Route("/phones/edit/{id}", name="update_phone", methods={"PUT"})
     * @OA\RequestBody(
     *     request="Phone update",
     *     description="Modification you want to do",
     *     required=true,
     *     @OA\JsonContent(@OA\Schema(
     *         type="json"
     *     )),     
     * )
     * @OA\Response(
     *         response=200,
     *         description="Modification succeded"
     * )
     * @OA\Response(
     *         response=401,
     *         description="Modification failed"
     * )
     * @OA\Tag(name="Phone")
     * @Secu(name="Bearer")
     */
    public function update(Request $request, SerializerInterface $serializer, Phone $phone, EntityManagerInterface $entityManager)
    {
        $phoneUpdate = $entityManager->getRepository(Phone::class)->find($phone->getId());
        $data = json_decode($request->getContent());
        foreach ($data as $key => $value){
            if($key && !empty($value)) {
                $name = ucfirst($key);
                $setter = 'set'.$name;
                $phoneUpdate->$setter($value);
            }
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Le téléphone a bien été mis à jour'
        ];
        return new JsonResponse($data);
    }
}
