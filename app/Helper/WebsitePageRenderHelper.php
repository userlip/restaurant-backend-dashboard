<?php

namespace App\Helper;

use App\Models\Theme;

class WebsitePageRenderHelper
{
    public static function getThemeTemplate(Theme $theme): array
    {
        return match ($theme?->template) {
            "template_1" => [
                "view" => "templates.template-1",
                "layout" => 'components.template-layouts.template-1',
            ],

            "template_2" => [
                "view" => "templates.template-2",
                "layout" => 'components.template-layouts.template-2',
            ],

            default => [
                "view" => 'home',
                "layout" => 'components.layouts.page-layout',
            ]
        };
    }
}
