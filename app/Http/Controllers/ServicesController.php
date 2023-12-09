<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ServiceRepositoryInterface;
use App\Services\Admin\ServicesService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServicesController extends Controller
{
    private const SERVICE_CAT_Id = 6;

    public function __construct(
        private readonly ServicesService             $servicesService,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ServiceRepositoryInterface  $serviceRepository
    )
    {
    }

    public function __invoke(): View|Factory
    {
        $term = $this->categoryRepository->findById(self::SERVICE_CAT_Id);
        $service = $this->serviceRepository->findByOne(['status' => 1, 'id' => 1]);
        if (is_null($service)) {
            throw new ModelNotFoundException;
        }
        $services = $this->serviceRepository->findBy(['status' => 1], ['created_at' => 'ASC'], 3);
        if ($services->count() === 0) {
            throw new ModelNotFoundException;
        }

        $servicesData = [];
        foreach ($services as $key => $item) {
            $servicesData[$key] = $this->servicesService->generateData($item);
        }
        $serviceData = $this->servicesService->generateData($service);

        return view('frontend/services/index', [
            'services' => $servicesData,
            'service' => $serviceData,
            'page' => $term
        ]);
    }

    public function show(string $slug): View|Factory
    {
        $service = $this->serviceRepository->findByOne(['slug' => $slug, 'status' => 1]);
        if (is_null($service)) {
            throw new ModelNotFoundException;
        }
        $services = $this->serviceRepository->findBy(['status' => 1], ['created_at' => 'ASC'], 3);
        if ($services->count() === 0) {
            throw new ModelNotFoundException;
        }
        $servicesData = [];
        foreach ($services as $key => $item) {
            $servicesData[$key] = $this->servicesService->generateData($item);
        }
        $serviceData = $this->servicesService->generateData($service);
        return view('frontend/services/index', [
            'services' => $servicesData,
            'service' => $serviceData,
            'page' => $service,
        ]);
    }
}
