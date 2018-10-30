<?php

namespace App\Controller;

use App\Service\StateService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiStateController extends Controller
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var StateService */
    private $stateService;

    /**
     * ApiStateController constructor.
     * @param SerializerInterface $serializer
     * @param StateService $stateService
     */
    public function __construct(SerializerInterface $serializer, StateService $stateService)
    {
        $this->serializer = $serializer;
        $this->stateService = $stateService;
    }

    /**
     * @Rest\Get("/api/states", name="getAllStates")
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {
        $stateEntities = $this->stateService->getAllWithTaxData();
        $data = $this->serializer->serialize($stateEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }
    
    /**
     * @Rest\Post("/api/state/create", name="createState")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $message = $request->request->get('message');
        $stateEntity = $this->stateService->create($message);
        $data = $this->serializer->serialize($stateEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }
}