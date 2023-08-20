<?php

namespace App\Services\Admin;

use App\Enums\ProjectAdminWidgetEnum;
use App\Enums\ProjectFrontendWidgetEnum;
use App\Exceptions\WidgetNotFoundException;
use App\Services\FileService;
use App\ValueObjects\Files;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostService
{
    private string $filePath;

    public function __construct(
        private readonly FileService $fileService
    )
    {
        $this->filePath = config('files-path.project.publicImagePath');
    }

    public function matchingRequestData(array $requestData, array $widgetAllFiles): array
    {
        $data = [];

        if (!isset($requestData['widgets'])) {
            throw new WidgetNotFoundException('Вы забыли добавить виджеты');
        }
        foreach ($requestData['widgets'] as $key => $widget) {
            foreach ($widget as $widgetKey => $widgetValue) {
                $data['data'][$key][$widgetKey] = $widgetValue;
            }
        }

        if (isset($widgetAllFiles['widgets'])) {
            foreach ($widgetAllFiles['widgets'] as $widgetKey => $widgetItem) {
                foreach ($widgetItem['data']['files'] as $file) {
                    $data['data'][$widgetKey]['data']['files'][] = $this->fileService->saveFile($file, $this->filePath);
                }
            }
        }

        return $data;
    }

    public function setWidgetsData(array $dataWidgets): array
    {
        return [
            'frontend' => array_map(static function ($widget) {
                $widgetClassName = ProjectFrontendWidgetEnum::getWidgetClass($widget['name']);
                return new $widgetClassName($widget);
            }, $dataWidgets),
            'admin' => array_map(static function ($widget) {
                $widgetClassName = ProjectAdminWidgetEnum::getWidgetClass($widget['name']);
                return new $widgetClassName($widget);
            }, $dataWidgets)
        ];
    }

    public function setPostData(array $formData, array $filesData, string $body): array
    {
        $previewImageName = $this->fileService->saveFile($filesData['preview_file'], $this->filePath);
        $files = new Files();
        if (isset($filesData['apartment_images'])){
            foreach ($filesData['apartment_images'] as $image){
                $fileName = $this->fileService->saveFile($image, $this->filePath);
                $files->setFile($fileName);
            }
        }

        unset($formData['additionalPosts']);
        return array_merge($formData, [
            'preview_image' => $previewImageName,
            'apartment_images' => json_encode($files),
            'body' => $body
        ]);
    }
}
