<?php

namespace App\Livewire;

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

        return view($template['view'])
            ->layout($template['layout']);
    }

    public function mount(string $template)
    {
        $this->template = $template;
    }
}
