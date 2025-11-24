@props(['company_logos'])

@if (!empty($company_logos['special_logo']))
  <div class="md:col-span-3">
    <img alt="Más de 10 años exportando" class="mx-auto aspect-square" src="{{ $company_logos['special_logo'] }}" />
  </div>
@endif
