<?php

namespace App\ValueObjects;

use App\Exceptions\TemplateInvalidArgumentException;

class FirstTemplate
{
    private string $name;
    private string $firstSectionTitle;
    private ServiceTemplateJson $firstSectionDescription;

    public function __construct(
        array $templateData
    )
    {
        if (!isset($templateData['first_section_title']) || mb_strlen($templateData['first_section_title']) < 1){
            throw new TemplateInvalidArgumentException('Заполните заголовок в шаблоне 1', 422);
        }
        if (!isset($templateData['first_section_description'])){
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 1', 422);
        }
        $firstSectionDescription = json_decode($templateData['first_section_description']);
        if (count($firstSectionDescription) === 0){
            throw new TemplateInvalidArgumentException('Заполните этапы работы в шаблоне 1', 422);
        }

        $this->name = $templateData['name'];
        $this->firstSectionTitle = $templateData['first_section_title'];
        $this->firstSectionDescription = new ServiceTemplateJson($firstSectionDescription);

    }

    public function getFormData(): array
    {
        return [
            'name' => $this->name,
            'first_section_title' => $this->firstSectionTitle,
            'first_section_description' => json_encode($this->firstSectionDescription)
        ];
    }
    public function getAdminData(): array
    {
        return [
            'name' => $this->name,
            'first_section_title' => $this->firstSectionTitle,
            'first_section_description' => $this->firstSectionDescription->jsonSerialize()
        ];
    }
}
