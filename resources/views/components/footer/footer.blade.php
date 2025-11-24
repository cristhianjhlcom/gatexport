<section>
  <div class="bg-primary-500 text-white">
    <div class="container mx-auto flex h-20 items-center justify-between gap-x-4 px-4">
      <x-footer.follow-us :$general_information />
      <x-footer.utils />
    </div>
  </div>

  <footer class="bg-primary-600 py-8 text-white">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-12">
        <x-footer.company :$general_information :$company_logos />

        <div class="space-y-4 md:col-span-3">
          <x-footer.address :$general_information />
          <x-footer.contact :$general_information />
        </div>

        <x-footer.n-years-logo :$company_logos />
      </div>
    </div>
  </footer>
</section>
