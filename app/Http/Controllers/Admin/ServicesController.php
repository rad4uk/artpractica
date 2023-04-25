<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Service;
use App\Repositories\ServicesRepository;
use App\Services\Admin\ServicesService;
use App\ValueObjects\FirstTemplate;
use App\ValueObjects\SecondTemplate;
use App\ValueObjects\ThirdTemplate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            $previewImageName = $this
                ->servicesService
                ->saveFile($filesData['formData']['preview_image']);

            $requestData['formData']['page_id'] = $requestData['formData']['page_id'] == '-1' ? null : $requestData['formData']['page_id'];
            if (isset($filesData['formData']['page_image'])
                && $filesData['formData']['page_image'] instanceof UploadedFile){
                $pageImageName = $this->servicesService->saveFile($filesData['formData']['page_image']);
                $requestData['formData']['page_image'] = $pageImageName;
            }

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
            'categories' => $categories,
            'pages' => Page::all(),
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
             * @var FirstTemplate|SecondTemplate|ThirdTemplate $templateInstance
             */

            if (isset($filesData['formData']['preview_image'])){
                $previewImageName = $this->servicesService->saveFile($filesData['formData']['preview_image']);
                $requestData['formData']['preview_image'] = $previewImageName;
            }

            $requestData['formData']['page_id'] = $requestData['formData']['page_id'] == '-1' ? null : $requestData['formData']['page_id'];
            if (isset($filesData['formData']['page_image'])
                && $filesData['formData']['page_image'] instanceof UploadedFile){
                $pageImageName = $this->servicesService->saveFile($filesData['formData']['page_image']);
                $requestData['formData']['page_image'] = $pageImageName;
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
            'templateData' => $service->admin_template_data,
            'pages' => Page::all(),
        ]);
    }

    public function preview(int $postId)
    {

    }
}
