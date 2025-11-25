<div class="hidden items-center gap-4 md:flex">
  <x-footer.nav-link
    :isActive="request()->is('politicas/politica-de-privacidad')"
    :title="__('pages.policies.privacy.title')"
    :url="route('politics.show', 'politica-de-privacidad')"
  >
    {{ __('pages.policies.privacy.title') }}
  </x-footer.nav-link>
  <x-footer.nav-link
    :isActive="request()->routeIs('faqs.index')"
    :title="__('pages.faqs.title')"
    :url="route('faqs.index')"
  >
    {{ __('pages.faqs.title') }}
  </x-footer.nav-link>
</div>
