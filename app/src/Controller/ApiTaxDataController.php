<?php

namespace App\Controller;

use App\Service\TaxDataService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiTaxDataController extends Controller
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
     * @Rest\Get("/api/taxdata", name="getAllTaxDatas")
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {   
        $this->taxDataService->updateTax();
        $taxDataEntities = $this->taxDataService->getAll();
        $data = $this->serializer->serialize($taxDataEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Get("/api/taxdata/{id}", name="getTaxData")
     * @return JsonResponse
     */
    public function getAction(int $id): JsonResponse
    {
        $taxDataEntity = $this->taxDataService->getOne($id);
        $data = $this->serializer->serialize($taxDataEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Post("/api/taxdata/create", name="createTaxData")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $title = $request->request->get('title');
        $taxDataEntity = $this->taxDataService->create($title);
        $data = $this->serializer->serialize($taxDataEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }
}