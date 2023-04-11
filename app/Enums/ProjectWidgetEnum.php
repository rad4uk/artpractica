<?php

namespace App\Enums;

use App\Exceptions\WidgetNotFoundException;
use App\Widgets\Projects\Widget1;
use App\Widgets\Projects\Widget2;
use App\Widgets\Projects\Widget3;
use App\Widgets\Projects\Widget4;

enum ProjectWidgetEnum: string
{
    case Widget1 = Widget1::class;
    case Widget2 = Widget2::class;
    case Widget3 = Widget3::class;
    case Widget4 = Widget4::class;

    public static function getWidgetClass(string $widgetName): string
    {
        return match ($widgetName) {
            ProjectWidgetEnum::Widget1->name => ProjectWidgetEnum::Widget1->value,
            ProjectWidgetEnum::Widget2->name => ProjectWidgetEnum::Widget2->value,
            ProjectWidgetEnum::Widget3->name => ProjectWidgetEnum::Widget3->value,
            ProjectWidgetEnum::Widget4->name => ProjectWidgetEnum::Widget4->value,
            default => throw new WidgetNotFoundException(sprintf('Ошибка, виджет %s не найден', $widgetName))
        };
    }
}
