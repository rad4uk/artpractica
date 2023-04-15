<?php

namespace App\Enums;

use App\Exceptions\WidgetNotFoundException;
use App\Widgets\Projects\Widget1;
use App\Widgets\Projects\Widget2;
use App\Widgets\Projects\Widget3;
use App\Widgets\Projects\Widget4;

enum ProjectFrontendWidgetEnum: string
{
    case Widget1 = Widget1::class;
    case Widget2 = Widget2::class;
    case Widget3 = Widget3::class;
    case Widget4 = Widget4::class;

    public static function getWidgetClass(string $widgetName): string
    {
        return match ($widgetName) {
            ProjectFrontendWidgetEnum::Widget1->name => ProjectFrontendWidgetEnum::Widget1->value,
            ProjectFrontendWidgetEnum::Widget2->name => ProjectFrontendWidgetEnum::Widget2->value,
            ProjectFrontendWidgetEnum::Widget3->name => ProjectFrontendWidgetEnum::Widget3->value,
            ProjectFrontendWidgetEnum::Widget4->name => ProjectFrontendWidgetEnum::Widget4->value,
            default => throw new WidgetNotFoundException(sprintf('Ошибка, виджет %s не найден', $widgetName))
        };
    }
}
