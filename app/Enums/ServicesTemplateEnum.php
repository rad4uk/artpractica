<?php

namespace App\Enums;

use App\Exceptions\TemplateNotFoundException;
use App\ValueObjects\FirstTemplate;
use App\ValueObjects\SecondTemplate;
use App\ValueObjects\ThirdTemplate;

enum ServicesTemplateEnum: string
{
    case firstTemplate = FirstTemplate::class;
    case secondTemplate = SecondTemplate::class;
    case thirdTemplate = ThirdTemplate::class;

    public static function getTemplateClass(string $templateName): string
    {
        return match ($templateName) {
            ServicesTemplateEnum::firstTemplate->name => ServicesTemplateEnum::firstTemplate->value,
            ServicesTemplateEnum::secondTemplate->name => ServicesTemplateEnum::secondTemplate->value,
            ServicesTemplateEnum::thirdTemplate->name => ServicesTemplateEnum::thirdTemplate->value,
            default => throw new TemplateNotFoundException(sprintf('Ошибка, шаблон %s не найден', $templateName))
        };
    }
}
