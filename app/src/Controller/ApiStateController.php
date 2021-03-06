<?php

namespace App\Controller;

use App\Service\TaxDataService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiStateController extends Controller
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var TaxDataService */
    private $taxDataService;

    /**
     * ApiTaxDataController constructor.
     * @param SerializerInterface $serializer
     * @param TaxDataService $taxDataService
     */
    public function __construct(SerializerInterface $serializer, TaxDataService $taxDataService)
    {
        $this->serializer = $serializer;
        $this->taxDataService = $taxDataService;
    }

    /**
     * @Rest\Get("/api/states", name="getAllStates")
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {
        $this->taxDataService->updateTax();
        $stateEntities = $this->taxDataService->getAllByType('state');
        $data = $this->serializer->serialize($stateEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }
    
    /**
     * @Rest\Post("/api/states/create", name="createState")
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