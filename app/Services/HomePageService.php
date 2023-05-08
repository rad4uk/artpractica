<?php

namespace App\Services;

use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class HomePageService
{
    public function setAdditionalCategories(Collection $categories): array
    {
        $data = [];
        foreach ($categories as $key => $category){
            $data[$key]['title'] = $category->title;
            $data[$key]['slug'] = route('categories', $category->slug);
            $data[$key]['image'] = [
                'default' => asset($category->getFilePath($category->page_image)),
                'small' => $category->makeThumbnail($category->page_image, config('thumbnail.home_page_sizes.additional_categories.small')),
                'medium' => $category->makeThumbnail($category->page_image, config('thumbnail.home_page_sizes.additional_categories.medium')),
                'large' => $category->makeThumbnail($category->page_image, config('thumbnail.home_page_sizes.additional_categories.large')),
            ];
        }
        return $data;
    }

    public function setAdditionalServices(Collection $services): array
    {
        $data = [];
        foreach ($services as $key => $service){
            $data[$key]['title'] = $service->tab_title ?? $service->title;
            $data[$key]['description'] = $service->page_description;
            $data[$key]['image'] = [
                'default' => asset($service->getFilePath($service->page_image)),
                'small' => $service->makeThumbnail($service->page_image, config('thumbnail.home_page_sizes.additional_services.small')),
                'medium' => $service->makeThumbnail($service->page_image, config('thumbnail.home_page_sizes.additional_services.medium')),
                'large' => $service->makeThumbnail($service->page_image, config('thumbnail.home_page_sizes.additional_services.large')),
            ];
            $data[$key]['slug'] = route('service', $service->slug);
        }
        return $data;
    }

    public function setSlidersData(mixed $sliders, Page $page)
    {
        if ($sliders !== null){
            foreach ($sliders as $slider){
                if (count($slider->files) > 0){
                    foreach ($slider->files as $key => $file){
//                        $slider->files[$key] = $page->getFilePath($file);
                        $slider->files[$key] = [
                            'default' => $page->getFilePath($file),
                            'small' => $page->makeThumbnail($file, config('thumbnail.home_page_sizes.sliders.small')),
                            'medium' => $page->makeThumbnail($file, config('thumbnail.home_page_sizes.sliders.medium')),
                            'large' => $page->makeThumbnail($file, config('thumbnail.home_page_sizes.sliders.large')),
                        ];
                    }
                }
            }
        }
        return $sliders;
    }
}
