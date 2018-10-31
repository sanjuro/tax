<?php

namespace App\Controller;

use App\Service\TaxDataService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiCountryController extends Controller
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
     * @Rest\Get("/api/countries", name="getAllCountries")
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {   
        $this->taxDataService->updateTax();
        $taxDataEntities = $this->taxDataService->getAllByType('country');
        $data = $this->serializer->serialize($taxDataEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Get("/api/countries/{id}", name="getCountry")
     * @return JsonResponse
     */
    public function getAction(int $id): JsonResponse
    {
        $taxDataEntity = $this->taxDataService->getOne($id);
        $data = $this->serializer->serialize($taxDataEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }

}