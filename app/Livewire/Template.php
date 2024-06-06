<?php

namespace App\Livewire;

use App\Models\Theme;
use Livewire\Component;

class Template extends Component
{
    public string $template;

    public function render()
    {
        $template = match ($this->template) {
            default => [
                "view" => "templates.template-1",
                "layout" => 'components.template-layouts.template-1',
            ]
        };

        $data = collect(Theme::first()->data)
            ->mapWithKeys(function (array $item) {
                return [
                    $item['type'] => $item['data'],
                ];
            });

        return view($template['view'], ['page_data' => $data])
            ->layout($template['layout']);
    }

    public function mount(string $template)
    {
        $this->template = $template;
    }
}
