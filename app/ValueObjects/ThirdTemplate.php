<?php

namespace App\ValueObjects;

use App\Exceptions\TemplateInvalidArgumentException;

class ThirdTemplate
{
    private string $name;
    private ServiceTemplateJson $firstSectionDescription;
    private string $secondSectionTitle;
    private string $secondSectionImage;
    private string $secondSectionDescription;
    private string $thirdSectionTitle;
    private string $thirdSectionDescription;
    private array $thirdSectionImages;


    public function __construct(
        array $templateData
    )
    {
        if (!isset($templateData['first_section_description'])) {
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 3', 422);
        }
        $firstSectionDescription = json_decode($templateData['first_section_description']);
        if (count($firstSectionDescription) === 0) {
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 3', 422);
        }

        if (!isset($templateData['second_section_title']) || mb_strlen($templateData['second_section_title']) < 1) {
            throw new TemplateInvalidArgumentException('Заполните заголовок в шаблоне 3', 422);
        }

        if (!isset($templateData['second_section_image'])) {
            throw new TemplateInvalidArgumentException('Заполните Фото к первой секции в шаблоне 3', 422);
        }

        if (!isset($templateData['second_section_description']) || mb_strlen($templateData['second_section_description']) < 1) {
            throw new TemplateInvalidArgumentException('Заполните Описание к первой секции в шаблоне 3', 422);
        }

        if (!isset($templateData['third_section_title']) || mb_strlen($templateData['third_section_title']) < 1) {
            throw new TemplateInvalidArgumentException('Заполните Загаловок ко второй секции в шаблоне 3', 422);
        }

        if (!isset($templateData['third_section_description']) || mb_strlen($templateData['third_section_description']) < 1) {
            throw new TemplateInvalidArgumentException('Заполните Описание ко второй секции в шаблоне 3', 422);
        }

        if (!isset($templateData['third_section_images'])) {
            throw new TemplateInvalidArgumentException('Заполните Изображение ко второй секции в шаблоне 3', 422);
        }
        $thirdSectionImages = json_decode($templateData['third_section_images']);
        if (count($thirdSectionImages) < 3) {
            throw new TemplateInvalidArgumentException('Заполните Изображение ко второй секции в шаблоне 3 (количество изображений должно ровняться трем)', 422);
        }

        $this->name = $templateData['name'];
        $this->firstSectionDescription = new ServiceTemplateJson($firstSectionDescription);
        $this->secondSectionTitle = $templateData['second_section_title'];
        $this->secondSectionDescription = $templateData['second_section_description'];
        $this->secondSectionImage = $templateData['second_section_image'];
        $this->thirdSectionTitle = $templateData['third_section_title'];
        $this->thirdSectionDescription = $templateData['third_section_description'];
        $this->thirdSectionImages = $thirdSectionImages;

    }

    public function getFormData(): array
    {
        return [
            'name' => $this->name,
            'second_section_title' => $this->secondSectionTitle,
            'second_section_description' => $this->secondSectionDescription,
            'second_section_image' => $this->secondSectionImage,
            'first_section_description' => json_encode($this->firstSectionDescription),
            'third_section_title' => $this->thirdSectionTitle,
            'third_section_description' => $this->thirdSectionDescription,
            'third_section_images' => json_encode($this->thirdSectionImages),
        ];
    }

    public function getAdminData(): array
    {
        return [
            'name' => $this->name,
            'second_section_title' => $this->secondSectionTitle,
            'second_section_description' => $this->secondSectionDescription,
            'second_section_image' => $this->secondSectionImage,
            'first_section_description' => $this->firstSectionDescription->jsonSerialize(),
            'third_section_title' => $this->thirdSectionTitle,
            'third_section_description' => $this->thirdSectionDescription,
            'third_section_images' => $this->thirdSectionImages,
        ];
    }
}
