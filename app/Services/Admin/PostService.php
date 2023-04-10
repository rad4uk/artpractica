<?php

namespace App\Services\Admin;

use App\Enums\ProjectWidgetEnum;
use App\Exceptions\WidgetNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostService
{
    private const FILE_PATH = '/images/project';

    public function matchingRequestData(array $requestData, array $widgetAllFiles): array
    {
        $data = [];
        if (!isset($requestData['widgets'])){
            throw new WidgetNotFoundException('Вы забыли добавить виджеты');
        }
        foreach ($requestData['widgets'] as $key => $requestItem) {
            $data[$key]['type'] = 'frontend';
            foreach ($requestItem as $itemKey => $itemValue) {
                $data[$key]['data']['name'] = $itemKey;
                foreach ($itemValue as $valueKey => $value) {
                    $data[$key]['data'][$valueKey] = $value;
                }
            }

        }

        if (isset($widgetAllFiles['widgets'])) {
            foreach ($widgetAllFiles['widgets'] as $widgetKey => $widgetItem) {
                foreach ($widgetItem as $widgetFileKey => $widgetFiles) {
                    if (isset($widgetFiles['files'])) {
                        /**
                         * @var UploadedFile $file
                         */
                        foreach ($widgetFiles['files'] as $file) {
                            $this->saveFile($file);
                            $data[$widgetKey]['data']['files'][] = $file->getClientOriginalName();
                        }
                    }
                }
            }
        }
        return $data;
    }

    public function setWidgetsData(array $dataWidgets): array
    {
        return array_map(static function ($widget) {
            $widgetClassName = ProjectWidgetEnum::getWidgetClass($widget['data']['name']);
            return new $widgetClassName($widget);
        }, $dataWidgets);
    }

    public function setPostData(array $formData, array $filesData, string $body): array
    {
        /**
         * @var UploadedFile $previewImage
         */
        $previewImage = $filesData['preview_file'];
        $this->saveFile($filesData['preview_file']);
        return array_merge($formData, [
            'preview_image' => $previewImage->getClientOriginalName(),
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
