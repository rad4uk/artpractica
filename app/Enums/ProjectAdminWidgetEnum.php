<?php

namespace App\Enums;

use App\Exceptions\WidgetNotFoundException;
use App\Widgets\Projects\Admin\Widget1;
use App\Widgets\Projects\Admin\Widget2;
use App\Widgets\Projects\Admin\Widget3;
use App\Widgets\Projects\Admin\Widget4;
use App\Widgets\Projects\Admin\Widget5;


enum ProjectAdminWidgetEnum: string
{
    case Widget1 = Widget1::class;
    case Widget2 = Widget2::class;
    case Widget3 = Widget3::class;
    case Widget4 = Widget4::class;
    case Widget5 = Widget5::class;

    public static function getWidgetClass(string $widgetName): string
    {
        return match ($widgetName) {
            ProjectAdminWidgetEnum::Widget1->name => ProjectAdminWidgetEnum::Widget1->value,
            ProjectAdminWidgetEnum::Widget2->name => ProjectAdminWidgetEnum::Widget2->value,
            ProjectAdminWidgetEnum::Widget3->name => ProjectAdminWidgetEnum::Widget3->value,
            ProjectAdminWidgetEnum::Widget4->name => ProjectAdminWidgetEnum::Widget4->value,
            ProjectAdminWidgetEnum::Widget5->name => ProjectAdminWidgetEnum::Widget5->value,
            default => throw new WidgetNotFoundException(sprintf('Ошибка, виджет %s не найден', $widgetName))
        };
    }
}
