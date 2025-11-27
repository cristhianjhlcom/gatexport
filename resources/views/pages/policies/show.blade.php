<x-layouts.public>
  <x-slot:seo>
    <x-common.seo.tags :title="$policy->title[app()->getLocale()]" />
  </x-slot>

  <div class="bg-primary-50">
    <div class="container space-y-10 py-10">
      <header class="flex flex-col space-y-4">
        <x-common.title
          class="text-center"
          level="1"
          size="super-title"
          weight="font-extrabold"
        >
          {{ $policy->title[app()->getLocale()] }}
        </x-common.title>
        <x-common.separator-line class="mx-auto w-full max-w-[1000px]" />
      </header>

      <div class="mx-auto flex w-full flex-col items-start gap-6">
        <div class="policies__content space-y-6 rounded-xl bg-white p-10">
          {!! $policy->content[app()->getLocale()] !!}
        </div>
      </div>
    </div>
  </div>

</x-layouts.public>
