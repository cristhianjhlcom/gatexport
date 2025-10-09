 <flux:card class="space-y-4">

   <flux:textarea
     badge="Requerido"
     description="Sera utilizado como el alt de la imagen"
     label="Título"
     placeholder="Ej: Sahumerios, Inciensos y Velas"
     wire:model="banners.{{ $locale }}.{{ $index }}.title"
   />

   {{-- <flux:textarea
     badge="{{ __('Required') }}"
     label="Descripción"
     placeholder="Descripción del Banner"
     wire:model="banners.{{ $locale }}.{{ $index }}.short_description"
   /> --}}

   {{-- <div class="grid grid-cols-1 gap-4 md:grid-cols-2"> --}}
   <div>
     {{-- <flux:input
       label="Texto del Enlace"
       placeholder="Comprar Ahora"
       wire:model="banners.{{ $locale }}.{{ $index }}.link_text"
     /> --}}

     <flux:input
       badge="Requerido"
       label="URL"
       placeholder="/catetories"
       wire:model="banners.{{ $locale }}.{{ $index }}.link_url"
     />
   </div>

   <flux:separator />

   @include('livewire.admin.settings.partials.banner-image')

   <div class="flex justify-end">
     <flux:button
       class="absolute right-0 top-0 z-10"
       icon:trailing="x-mark"
       size="sm"
       variant="danger"
       wire:click="remove('{{ $locale }}', {{ $index }})"
       wire:confim="Estas seguro que deseas eliminar este banner?"
     >
       Eliminar
     </flux:button>
   </div>
 </flux:card>
