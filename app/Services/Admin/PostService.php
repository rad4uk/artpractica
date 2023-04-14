<?php

namespace App\Services\Admin;

use App\Enums\ProjectWidgetEnum;
use App\Exceptions\WidgetNotFoundException;
use App\ValueObjects\Files;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostService
{
    private const FILE_PATH = '/images/project';

    public function matchingRequestData(array $requestData, array $widgetAllFiles): array
    {
        $data = [];

        if (!isset($requestData['widgets'])) {
            throw new WidgetNotFoundException('Вы забыли добавить виджеты');
        }
        foreach ($requestData['widgets'] as $key => $widget) {
            foreach ($widget as $widgetKey => $widgetValue) {
                $data['admin'][$key][$widgetKey] = $widgetValue;
            }
        }

        if (isset($widgetAllFiles['widgets'])) {
            foreach ($widgetAllFiles['widgets'] as $widgetKey => $widgetItem) {
                foreach ($widgetItem['data']['files'] as $file) {
                    /**
                     * @var UploadedFile $file
                     */
                    $this->saveFile($file);
                    $data['admin'][$widgetKey]['data']['files'][] = $file->getClientOriginalName();
                }
            }
        }

        return $data;
    }

    public function setWidgetsData(array $dataWidgets): array
    {
        return [
            'frontend' => array_map(static function ($widget) {
                $widgetClassName = ProjectWidgetEnum::getWidgetClass($widget['name']);
                return new $widgetClassName($widget);
            }, $dataWidgets)];
    }

    public function setPostData(array $formData, array $filesData, string $body): array
    {
        /**
         * @var UploadedFile $previewImage
         */
        $previewImage = $filesData['preview_file'];
        $this->saveFile($filesData['preview_file']);
        $files = new Files();
        foreach ($filesData['apartment_images'] as $image){
            $this->saveFile($image);
            $files->setFile($image);
        }
        unset($formData['additionalPosts']);
        return array_merge($formData, [
            'preview_image' => $previewImage->getClientOriginalName(),
            'apartment_images' => json_encode($files),
            'body' => $body
        ]);
    }


    public function saveFile(UploadedFile $file): void
    {
        Storage::disk('public')->putFileAs(
            self::FILE_PATH,
            $file,
            $file->getClientOriginalName()
        );
    }
}
