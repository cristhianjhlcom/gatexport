<section class="bg-white py-10 md:py-20 dark:bg-white">
  <div class="container space-y-6 md:space-y-10">
    <header class="space-y-4">
      <h2 class="text-primary-400 text-2xl font-black italic leading-tight md:text-5xl">
        {{ $title }}
      </h2>
    </header>

    <article class="flex flex-col justify-between gap-10 md:flex-row md:items-center">
      <div class="w-full space-y-2 leading-relaxed text-gray-900 md:w-8/12 dark:text-gray-900">
        {!! $description !!}
      </div>
      <div class="flex-1">
        <flux:modal.trigger class="flex md:justify-end" name="contact-form">
          <button class="rounded-4xl bg-primary-400 w-full px-6 py-4 text-xl font-extrabold uppercase text-white" type="button">
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
