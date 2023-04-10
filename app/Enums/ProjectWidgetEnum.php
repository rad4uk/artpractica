<?php

namespace App\Enums;

use App\Exceptions\WidgetNotFoundException;
use App\Widgets\Projects\Widget1;
use App\Widgets\Projects\Widget2;
use App\Widgets\Projects\Widget3;
use App\Widgets\Projects\Widget4;

enum ProjectWidgetEnum: string
{
    case widget1 = Widget1::class;
    case widget2 = Widget2::class;
    case widget3 = Widget3::class;
    case widget4 = Widget4::class;

    public static function getWidgetClass(string $widgetName): string
    {
        return match ($widgetName) {
            ProjectWidgetEnum::widget1->name => ProjectWidgetEnum::widget1->value,
            ProjectWidgetEnum::widget2->name => ProjectWidgetEnum::widget2->value,
            ProjectWidgetEnum::widget3->name => ProjectWidgetEnum::widget3->value,
            ProjectWidgetEnum::widget4->name => ProjectWidgetEnum::widget4->value,
            default => throw new WidgetNotFoundException(sprintf('Ошибка, виджет %s не найден', $widgetName))
        };
    }
}
