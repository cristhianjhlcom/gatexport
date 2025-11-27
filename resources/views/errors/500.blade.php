<x-layouts.errors>
  <main class="flex min-h-screen items-center justify-center">
    <section class="flex flex-col gap-4">
      <h1 class="text-9xl font-extrabold leading-relaxed">403</h1>
      <a
        :title="__('pages.home.go_to_home')"
        class="text-md rounded-md border border-zinc-400 bg-transparent px-4 py-3 text-center font-bold"
        href="{{ route('home.index') }}"
      >
        {{ __('pages.home.go_to_home') }}
      </a>
    </section>
  </main>
</x-layouts.errors>
