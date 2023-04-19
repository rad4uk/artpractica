<?php

namespace App\Services\Admin;

use App\Enums\ServicesTemplateEnum;
use App\Models\Service;
use App\ValueObjects\Files;
use App\ValueObjects\FirstTemplate;
use App\ValueObjects\SecondTemplate;
use App\ValueObjects\ThirdTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ServicesService
{
    private const FILE_PATH = '/images/services';

    public function getTemplateInstance(array $templateData): FirstTemplate|SecondTemplate|ThirdTemplate
    {
        $templateClass = ServicesTemplateEnum::getTemplateClass($templateData['name']);
        return new $templateClass($templateData);
    }

    public function saveFile(UploadedFile $file): string
    {
        Storage::disk('public')->putFileAs(
            self::FILE_PATH,
            $file,
            $file->getClientOriginalName()
        );
        return $file->getClientOriginalName();
    }

    public function getTemplateData(array $templateData, array $filesData): array
    {
        if (isset($filesData['second_section_image'])
            && $filesData['second_section_image'] instanceof UploadedFile){
            $templateData['second_section_image'] = $this->saveFile($filesData['second_section_image']);
        }
        if (isset($filesData['third_section_images']) && count($filesData['third_section_images']) > 0){
            /**
             * @var UploadedFile $file
             */
            $fileInstance = new Files();
            foreach ($filesData['third_section_images'] as $file){
                $this->saveFile($file);
                $fileInstance->setFile($file);
            }
            $templateData['third_section_images'] = json_encode($fileInstance);
        }
        return $templateData;
    }

    public function generateData(Service $service): array
    {
        $servicesData['title'] = $service->title;
        $servicesData['tab_title'] = $service->tab_title;
        $servicesData['description'] = $service->description;
        $servicesData['preview_image'] = $service->getFilePath($service->preview_image);
        $servicesData['first_section_description'] = $service->first_section_description !== null ? json_decode($service->first_section_description) : null;
        $servicesData['first_section_image'] = $service->first_section_image === null ? null : $service->getFilePath($service->first_section_image);
        $servicesData['first_section_title'] = $service->first_section_title;
        $servicesData['id'] = $service->id;
        $servicesData['name'] = $service->name;
        $servicesData['second_section_description'] = $service->second_section_description;
        $servicesData['second_section_title'] = $service->second_section_title;
        $servicesData['second_section_image'] = $service->second_section_image === null ? null : $service->getFilePath($service->second_section_image);
        $servicesData['slug'] = $service->slug;
        $servicesData['third_section_title'] = $service->third_section_title;
        $servicesData['third_section_description'] = $service->third_section_description;
        if ($service->third_section_images !== null){
            $thirdSectionImages = json_decode($service->third_section_images);
            if (count($thirdSectionImages) > 0){
                foreach ($thirdSectionImages as $image){
                    $servicesData['third_section_images'][] = $service->getFilePath($image);
                }
            }

        }

        return $servicesData;
    }
}
