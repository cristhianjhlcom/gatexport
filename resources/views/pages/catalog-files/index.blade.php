<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags :title="__('pages.catalogs.title')" />
  </x-slot>

  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="1"
          size="title"
          weight="font-extrabold"
        >
          {{ __('pages.catalogs.title') }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-sm" />
      </header>

      <livewire:public.catalogs.pdf-viewer />
    </div>
  </div>
</x-layouts.public>
