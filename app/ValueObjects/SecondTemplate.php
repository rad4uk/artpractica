<?php

namespace App\ValueObjects;

use App\Exceptions\TemplateInvalidArgumentException;

class SecondTemplate
{
    private string $name;
    private ServiceTemplateJson $firstSectionDescription;
    private string $secondSectionTitle;
    private string $secondSectionImage;
    private string $secondSectionDescription;
    private string $thirdSectionTitle;
    private string $thirdSectionDescription;


    public function __construct(
        array $templateData
    )
    {
        if (!isset($templateData['first_section_description'])){
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 2', 422);
        }
        $firstSectionDescription = json_decode($templateData['first_section_description']);
        if (count($firstSectionDescription) === 0){
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 2', 422);
        }

        if (!isset($templateData['second_section_title']) || mb_strlen($templateData['second_section_title']) < 1){
            throw new TemplateInvalidArgumentException('Заполните заголовок в шаблоне 2', 422);
        }

        if (!isset($templateData['second_section_image'])){
            throw new TemplateInvalidArgumentException('Заполните Фото ко второй секции в шаблоне 2', 422);
        }

        if (!isset($templateData['second_section_description']) || mb_strlen($templateData['second_section_description']) < 1){
            throw new TemplateInvalidArgumentException('Заполните Описание ко второй секции в шаблоне 2', 422);
        }

        if (!isset($templateData['third_section_title']) || mb_strlen($templateData['third_section_title']) < 1){
            throw new TemplateInvalidArgumentException('Заполните Заголовок к третьей секции в шаблоне 2', 422);
        }

        if (!isset($templateData['third_section_description']) || mb_strlen($templateData['third_section_description']) < 1){
            throw new TemplateInvalidArgumentException('Заполните Описание к третьей секции в шаблоне 2', 422);
        }

        $this->name = $templateData['name'];
        $this->firstSectionDescription = new ServiceTemplateJson($firstSectionDescription);
        $this->secondSectionTitle = $templateData['second_section_title'];
        $this->secondSectionDescription = $templateData['second_section_description'];
        $this->secondSectionImage = $templateData['second_section_image'];
        $this->thirdSectionTitle = $templateData['third_section_title'];
        $this->thirdSectionDescription = $templateData['third_section_description'];

    }

    public function getFormData(): array
    {
        return [
            'name' => $this->name,
            'first_section_description' => json_encode($this->firstSectionDescription),
            'second_section_title' => $this->secondSectionTitle,
            'second_section_image' => $this->secondSectionImage,
            'second_section_description' => $this->secondSectionDescription,
            'third_section_title' => $this->thirdSectionTitle,
            'third_section_description' => $this->thirdSectionDescription,
        ];
    }

    public function getAdminData(): array
    {
        return [
            'name' => $this->name,
            'first_section_description' => $this->firstSectionDescription->jsonSerialize(),
            'second_section_title' => $this->secondSectionTitle,
            'second_section_image' => $this->secondSectionImage,
            'second_section_description' => $this->secondSectionDescription,
            'third_section_title' => $this->thirdSectionTitle,
            'third_section_description' => $this->thirdSectionDescription,
        ];
    }
}
