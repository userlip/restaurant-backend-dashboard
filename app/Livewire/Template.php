<?php

namespace App\Livewire;

use App\Models\ContactUsMessage;
use App\Models\Theme;
use Livewire\Component;

class Template extends Component
{
    public string $template;

    public string $full_name;
    public ?string $email = null;
    public ?string $phone_number = null;
    public string $message;
    public $honeypot;
    public bool $is_submitted = false;

    public function render()
    {
        $template = match ($this->template) {
            "template-2" => [
                "view" => "templates.template-2",
                "layout" => 'components.template-layouts.template-2',
            ],

            default => [
                "view" => "templates.template-2",
                "layout" => 'components.template-layouts.template-2',
            ]
        };

        $data = collect(Theme::where('template', 'template_2')->first()->data)
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

    public function contactUs()
    {
        if ($this->honeypot !== null) {
            return;
        }

        $this->validate([
            'full_name' => 'required|string',
            'email' => 'required_without:phone_number|email',
            'phone_number' => 'required_without:email',
            'message' => 'required|string',
        ], [
            'phone_number.required_without' => __('validation.required', ['attribute' => "phone number"]),
            'email.required_without' => __('validation.required', ['attribute' => "email"]),
        ]);

        $fullName = $this->full_name;
        $email = $this->email;
        $phone_number = $this->phone_number ?? null;
        $message = $this->message;

        $contact = ContactUsMessage::create([
            'full_name' => $fullName,
            'email' => $email,
            'phone_number' => $phone_number,
            'message' => $message,
        ]);

        if ($contact) {
            $this->full_name = "";
            $this->email = "";
            $this->phone_number = "";
            $this->message = "";

            session()->flash('contact_us_message', "Thank you for contacting us, we have received your message!");
        }
    }
}
