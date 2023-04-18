<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Repositories\ServicesRepository;
use App\Services\Admin\ServicesService;
use App\ValueObjects\FirstTemplate;
use App\ValueObjects\SecondTemplate;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function __construct(
        public readonly ServicesRepository $servicesRepository,
        private readonly ServicesService   $servicesService
    )
    {
    }

    public function index()
    {
        return view('adminlte.services.index', [
            'posts' => $this->servicesRepository->list()
        ]);
    }

    public function create(Request $request)
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();
        if ($request->isMethod('POST')){
            $requestData = $request->request->all();
            $filesData = $request->files->all();
            /**
             * @var FirstTemplate|SecondTemplate $templateInstance
             */
            $previewImageName = $this->servicesService->saveFile($filesData['formData']['preview_image']);
            $requestData['formData']['preview_image'] = $previewImageName;
            $templateData = $this->servicesService->getTemplateData(
                $requestData['templateData'],
                $filesData['templateData'] ?? []
            );

            $templateInstance = $this->servicesService->getTemplateInstance(
                $templateData
            );

            $requestData['formData']['admin_template_data'] = json_encode($templateInstance->getAdminData());

            $this->servicesRepository->create(
                array_merge($requestData['formData'], $templateInstance->getFormData())
            );

            return response('', 201);
        }

        return view('adminlte.services.new', [
            'categories' => $categories
        ]);
    }

    public function update(Request $request, int $serviceId)
    {
        $categories = Category::with('childrenRecursive')
            ->whereNull('parent_id')
            ->get();

        $service = Service::where('id', $serviceId)->firstOrFail();
        if ($request->isMethod('POST')){
            $requestData = $request->request->all();
            $filesData = $request->files->all();
            /**
             * @var FirstTemplate|SecondTemplate $templateInstance
             */

            if (isset($filesData['formData']['preview_image'])){
                $previewImageName = $this->servicesService->saveFile($filesData['formData']['preview_image']);
                $requestData['formData']['preview_image'] = $previewImageName;
            }

            $templateData = $this->servicesService->getTemplateData(
                $requestData['templateData'],
                $filesData['templateData'] ?? []
            );

            $templateInstance = $this->servicesService->getTemplateInstance(
                $templateData
            );

            $requestData['formData']['admin_template_data'] = json_encode($templateInstance->getAdminData());

            $this->servicesRepository->update(
                $serviceId,
                array_merge($requestData['formData'], $templateInstance->getFormData())
            );

            return response('', 201);
        }

        return view('adminlte.services.edit', [
            'categories' => $categories,
            'service' => $service,
            'templateData' => $service->admin_template_data
        ]);
    }

    public function preview(int $postId)
    {

    }
}
