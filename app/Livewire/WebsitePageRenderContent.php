<?php

namespace App\Livewire;

use App\Enums\SupportedLocaleEnums;
use App\Helper\WebsitePageRenderHelper;
use App\Models\ContactUsMessage;
use App\Models\Website;
use Livewire\Component;

class WebsitePageRenderContent extends Component
{
    public string $template;

    public string $full_name;
    public ?string $email = null;
    public ?string $phone_number = null;
    public string $message;
    public $honeypot;
    public bool $is_submitted = false;

    public $locale;

    public ?Website $website;

    public function render()
    {
        $domain = request()->getHost();
        $website = Website::where('domain', $domain)->first();

        if ($website === null) {
            return view('home')->layout('components.layouts.page-layout');
        }

        $this->website = $website;

        $theme = $website->theme;
        $themeData = $website->theme_data;

        $template = WebsitePageRenderHelper::getThemeTemplate($theme);

        $data = collect($themeData)
            ->mapWithKeys(function (array $item) {
                return [
                    $item['type'] => $item['data'],
                ];
            });

        return view($template['view'], ['page_data' => $data])
            ->layout($template['layout']);
    }

    public function contactUs()
    {
        if ($this->honeypot !== null) {
            return;
        }

        $this->validate([
            'full_name' => 'required|string',
            'email' => 'sometimes|required_without_all:phone_number|email|nullable',
            'phone_number' => 'required_without_all:email|nullable',
            'message' => 'required|string',
        ], [
            'phone_number.required_without' => __('validation.required', ['attribute' => "phone number"]),
            'email.required_without' => __('validation.required', ['attribute' => "email"]),
        ]);

        $fullName = $this->full_name;
        $email = $this->email;
        $phone_number = $this->phone_number ?? null;
        $message = $this->message;
        $website = $this->website;

        $contact = ContactUsMessage::create([
            'full_name' => $fullName,
            'email' => $email,
            'phone_number' => $phone_number,
            'message' => $message,
            'website_id' => $website->id,
        ]);

        if ($contact) {
            $this->full_name = "";
            $this->email = "";
            $this->phone_number = "";
            $this->message = "";

            session()->flash('contact_us_message', "Thank you for contacting us, we have received your message!");
        }
    }

    public function changeLocale(string $locale = "en"): void
    {
        $supportedLocales = SupportedLocaleEnums::getOptions();
        $token = session()->get('_token');

        if (in_array($locale, $supportedLocales, true)) {
            \App::setLocale($locale);

            if ($token) {
                \Cache::put($token, $locale, now()->addDays(2));
            }

            $this->reset();
            $this->js('window.location.reload()');
        }
    }
}
