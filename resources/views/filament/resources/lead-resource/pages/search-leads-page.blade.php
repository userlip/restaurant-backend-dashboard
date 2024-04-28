<x-filament-panels::page>
  <div class='fi-section rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10'>
    <div class='fi-section-content-ctn'>
      <form wire:submit="getLeads" class='fi-section-content p-6'>
        <div class=''>
          {{ $this->form }}
        </div>

        <button type="submit" class='w-full bg-primary-500 py-2 mt-4 rounded-xl'>
          Search Leads
        </button>
      </form>
    </div>
  </div>

  <x-filament-actions::modals />

</x-filament-panels::page>
