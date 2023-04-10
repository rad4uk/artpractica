<?php

namespace App\Services\Admin;

use App\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PostService
{
    private const FILE_PATH = '/images/project';

    public function __construct(
        private readonly PostRepositoryInterface $postRepository
    )
    {
    }

    public function matchingRequestData(array $requestData, array $widgetAllFiles): array
    {
        $data = [];
        foreach ($requestData['widgets'] as $key => $requestItem) {
            $data[$key]['type'] = 'frontend';
            foreach ($requestItem as $itemKey => $itemValue) {
                $data[$key]['data']['name'] = $itemKey;
                foreach ($itemValue as $valueKey => $value){
                    $data[$key]['data'][$valueKey] = $value;
                }
            }

        }

        foreach ($widgetAllFiles['widgets'] as $widgetKey => $widgetItem) {
            foreach ($widgetItem as $widgetFileKey => $widgetFiles){
                if (isset($widgetFiles['files'])) {
                    foreach ($widgetFiles['files'] as $file) {
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $this->saveFile($file, $fileName);
                        $data[$widgetKey]['data']['files'][] = $fileName;
                    }
                }
            }
        }

        return $data;
    }

    public function createPost(array $formData, array $widgetData, UploadedFile $file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $this->saveFile($file, $fileName);
        $formData['preview_image'] = $fileName;
        $formData['body'] = json_encode($widgetData);
        $this->postRepository->create($formData);
    }


    private function saveFile(UploadedFile $file, string $fileName): void
    {
        Storage::disk('public')->putFileAs(
            self::FILE_PATH,
            $file,
            $fileName
        );
    }
}
