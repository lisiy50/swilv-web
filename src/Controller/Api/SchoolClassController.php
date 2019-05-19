<?php

namespace App\Controller\Api;

use App\Entity\SchoolClass;
use App\Repository\SchoolClassRepository;
use App\Service\ValidatorService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/school_classes")
 */
class SchoolClassController extends Controller
{

    /**
     * @Route("/", name="api_school_classes", methods={"GET"})
     */
    public function index(SchoolClassRepository $schoolClassRepository): Response
    {
        return $this->json($schoolClassRepository->findAllAsArray());
    }

    /**
     * @Route("/", name="api_school_classes_new", methods={"POST"})
     */
    public function new(Request $request, ValidatorService $validator): Response
    {
        $this->_replaceRequestData($request);

        $schoolClass = new SchoolClass();
        $schoolClass->setName($request->get('name'));
        $schoolClass->setIsActive($request->get('isActive'));

        if ($validator->validate($schoolClass)) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($schoolClass);
            $entityManager->flush();

            $responseData = $schoolClass->asArray();
            $responseCode = 200;
        } else {
            $responseData = [
                'message' => 'Something went wrong.',
                'errors' => $validator->getErrors(),
            ];
            $responseCode = 404;
        }

        return $this->json($responseData, $responseCode);
    }

    /**
     * @Route("/{id}", name="api_school_classes_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(SchoolClass $schoolClass): Response
    {
        return $this->json($schoolClass->asArray());
    }

    /**
     * @Route("/{id}", name="api_school_classes_edit", methods={"PUT"}, requirements={"id"="\d+"})
     */
    public function edit(Request $request, SchoolClass $schoolClass, ValidatorService $validator): Response
    {
        $this->_replaceRequestData($request);

        $schoolClass->setName($request->get('name'));
        $schoolClass->setIsActive($request->get('isActive'));

        if ($validator->validate($schoolClass)) {
            $this->getDoctrine()->getManager()->flush();

            $responseData = $schoolClass->asArray();
            $responseCode = 200;
        } else {
            $responseData = [
                'message' => 'Something went wrong.',
                'errors' => $validator->getErrors(),
            ];
            $responseCode = 404;
        }


        return $this->json($responseData, $responseCode);
    }

    /**
     * @Route("/{id}", name="api_school_classes_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, SchoolClass $schoolClass): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($schoolClass);
        $entityManager->flush();

        return $this->json(['status' => 'OK', 'message' => 'Entity removed']);
    }
}
