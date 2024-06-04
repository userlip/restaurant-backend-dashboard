<?php

namespace App\Livewire\Pages;

use App\Enums\SupportedLocaleEnums;
use Livewire\Component;

class Home extends Component
{
    public $locale;

    public function render()
    {
        if ($token = session()?->get('_token')) {
            $this->locale = $locale = \Cache::get($token, SupportedLocaleEnums::de->name);
            \App::setLocale($locale);
        }

        return view('home')->layout('components.layouts.page-layout');
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
        }
    }
}
