<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\Admin\ServicesService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct(
        private readonly ServicesService $servicesService
    )
    {
    }

    public function __invoke()
    {
        $service = Service::where('status', 1)->firstOrFail();
        $services = Service::where('status', 1)->limit(3)->get();
        $servicesData = [];
        foreach ($services as $key => $item){
            $servicesData[$key] = $this->servicesService->generateData($item);
        }
        $serviceData = $this->servicesService->generateData($service);

        return view('frontend/services/index', [
            'services' => $servicesData,
            'service' => $serviceData
        ]);
    }

    public function show(string $slug)
    {
        $service = Service::where(['slug' => $slug, 'status' => 1])->firstOrFail();
        $services = Service::where('status', 1)->limit(3)->get();
        $servicesData = [];
        foreach ($services as $key => $item){
            $servicesData[$key] = $this->servicesService->generateData($item);
        }
        $serviceData = $this->servicesService->generateData($service);
        return view('frontend/services/index', [
            'services' => $servicesData,
            'service' => $serviceData
        ]);
    }
}
