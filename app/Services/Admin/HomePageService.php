<?php

namespace App\Services\Admin;

use App\Services\FileService;
use App\ValueObjects\HomePageSlider;

class HomePageService
{
    private string $filePath;
    private FileService $fileService;

    public function __construct()
    {
        $this->filePath = config('files-path.pages.publicImagePath');
        $this->fileService = new FileService();
    }

    public function setSliderData(array $request, array $files): array
    {
        $data = [];
        if (isset($request['firstSliderData'])){
            if (!isset($request['firstSliderData']['title'])){
                throw new \RuntimeException('В первый слайдер не прописан заголовок', 422);
            }
            if ( !isset($files['firstSliderData']['files']) || $files['firstSliderData']['files'] === 0){
                throw new \RuntimeException('В первый слайдер не загруженны изображения', 422);
            }
        }
        if (isset($request['secondSliderData'])){
            if (!isset($request['secondSliderData']['title'])){
                throw new \RuntimeException('Во второй слайдер не прописан заголовок', 422);
            }
            if ( !isset($files['secondSliderData']['files']) || $files['secondSliderData']['files'] === 0){
                throw new \RuntimeException('Во второй слайдер не загруженны изображения', 422);
            }
        }
        if (isset($request['thirdSliderData'])){
            if (!isset($request['thirdSliderData']['title'])){
                throw new \RuntimeException('В третий слайдер не прописан заголовок', 422);
            }
            if ( !isset($files['thirdSliderData']['files']) || $files['thirdSliderData']['files'] === 0){
                throw new \RuntimeException('В третий слайдер не загруженны изображения', 422);
            }
        }
        $data['firstSliderData'] = $this->generateSliderData(
            'firstSliderData',
            $request['firstSliderData']['title'],
            $files['firstSliderData']['files']
        );
        $data['secondSliderData'] = $this->generateSliderData(
            'secondSliderData',
            $request['secondSliderData']['title'],
            $files['secondSliderData']['files']
        );
        $data['thirdSliderData'] = $this->generateSliderData(
            'thirdSliderData',
            $request['thirdSliderData']['title'],
            $files['thirdSliderData']['files']
        );

        return $data;
    }

    private function generateSliderData(string $sliderName, string $title, array $sliderFilesData): HomePageSlider
    {
        $sliderInstance = new HomePageSlider();
        $sliderInstance->setTitle($title);

        foreach ($sliderFilesData as $file){
            $this->fileService->saveFile($file, $this->filePath);
            $sliderInstance->setFile($file);
        }

        return $sliderInstance;
    }


}
