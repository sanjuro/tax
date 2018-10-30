<?php

namespace App\Controller;

use App\Service\CountryService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Serializer\SerializerInterface;

final class ApiCountryController extends Controller
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var CountryService */
    private $countryService;

    /**
     * ApiCountryController constructor.
     * @param SerializerInterface $serializer
     * @param CountryService $countryService
     */
    public function __construct(SerializerInterface $serializer, CountryService $countryService)
    {
        $this->serializer = $serializer;
        $this->countryService = $countryService;
    }

    /**
     * @Rest\Get("/api/countries", name="getAllCountries")
     * @return JsonResponse
     */
    public function listAction(): JsonResponse
    {   
        $this->countryService->updateTax();
        $countryEntities = $this->countryService->getAllWithTaxData();
        $data = $this->serializer->serialize($countryEntities, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Get("/api/countries/{id}", name="getCountry")
     * @return JsonResponse
     */
    public function getAction(int $id): JsonResponse
    {
        $countryEntity = $this->countryService->getOne($id);
        $data = $this->serializer->serialize($countryEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Rest\Post("/api/country/create", name="createCountry")
     * @param Request $request
     * @return JsonResponse
     */
    public function createAction(Request $request): JsonResponse
    {
        $message = $request->request->get('title');
        $countryEntity = $this->countryService->create($title);
        $data = $this->serializer->serialize($countryEntity, 'json');

        return new JsonResponse($data, 200, [], true);
    }
}