@php
  $data = $about['translations']['contact'];
  $title = $data['title'] ??= '';
  $description = $data['description'] ??= '';
@endphp

<section class="bg-white py-20 dark:bg-white">
  <div class="container space-y-10">
    <header class="space-y-4">
      <h2 class="text-primary-400 text-5xl font-black italic leading-tight">
        {{ $title }}
      </h2>
    </header>

    <article class="flex items-center justify-between gap-10">
      <div class="w-full space-y-2 md:w-8/12">{!! $description !!}</div>
      <div class="flex-1">
        <flux:modal.trigger class="flex justify-end" name="contact-form">
          <button class="rounded-4xl bg-primary-400 px-6 py-4 text-xl font-extrabold uppercase text-white"
            type="button">
            {{ __('pages.about.call_to_action') }}
          </button>
        </flux:modal.trigger>
        <flux:modal name="contact-form">
          <livewire:public.contact.contact-form />
        </flux:modal>
      </div>
    </article>
  </div>
</section>
