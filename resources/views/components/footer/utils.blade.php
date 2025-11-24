<div class="hidden items-center gap-4 md:flex">
  <x-footer.nav-link title="Política de privacidad" :isActive="request()->is('politicas/politica-de-privacidad')" :url="route('politics.show', 'politica-de-privacidad')">
    Política de Privacidad
  </x-footer.nav-link>
  <x-footer.nav-link title="Preguntas Frecuentes" :isActive="request()->routeIs('faqs.index')" :url="route('faqs.index')">
    Preguntas Frecuentes
  </x-footer.nav-link>
</div>
