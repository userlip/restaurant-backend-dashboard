@php
  $customer = \App\Models\Customer::find(data_get($this->data, 'customer_id'));
  $name = $customer?->name !== null ? "`{$customer->name}`": "null";
  $address = $customer?->address !== null ? "`{$customer->address}`": "null" ;
  $field = ucfirst(str_replace('_', ' ', $field));
  $chatGptAPIkey = config('chat-gpt.api_key')
@endphp
<div
  x-data="{
    isLoading: false,

    generateSeo: async function() {
      const name = {{ $name }};
      const address = {{ $address }};

      if (name === undefined || address === undefined) {
        return ;
      }

      this.isLoading = true;

      const payload = JSON.stringify([
        {
          content: 'Hello! I\'m an AI assistant bot based on ChatGPT 3. How may I help you?',
          role: 'system'
        },
        {
          content: `Erstelle eine {{ $field }} für ${name} in ${address}, maximal 175 zeichen`,
          role: 'user',
        }
      ])

      const options = {
        method: 'POST',
        headers: {
          'content-type': 'application/json',
          'X-RapidAPI-Key': '{{ $chatGptAPIkey }}',
          'X-RapidAPI-Host': 'chatgpt-api8.p.rapidapi.com'
        },
        body: payload,
      }

      const response = await fetch('https://chatgpt-api8.p.rapidapi.com/', options)
      const data = await response.text();
      let text = JSON.parse(data)
      text = text.text.replaceAll(/\{{ "\"" }}/g, @js(""))

      $wire.$set('data.seo_description', text)

      this.isLoading = false;
    },
  }"
>
  <button
    type='button'
    class='flex flex-row gap-x-1 items-center text-primary-400 font-bold'
    @click='generateSeo'>

    <template x-if='isLoading === false'>
      <span>
        {{ svg('heroicon-o-sparkles', 'w-6 h-auto') }}
      </span>
    </template>

    <template x-if='isLoading === true'>
      <x-filament::loading-indicator class="h-5 w-5" />
    </template>
    Fill with GPT
  </button>
</div>
