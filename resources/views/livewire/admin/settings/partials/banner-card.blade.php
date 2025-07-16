 <flux:card class="space-y-4">

   <flux:input
     label="Título"
     placeholder="Título del Banner"
     wire:model="banners.{{ $locale }}.{{ $index }}.title"
   />

   <flux:textarea
     label="Descripción"
     placeholder="Descripción del Banner"
     wire:model="banners.{{ $locale }}.{{ $index }}.short_description"
   />

   <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
     <flux:input
       label="Texto del Enlace"
       placeholder="Comprar Ahora"
       wire:model="banners.{{ $locale }}.{{ $index }}.link_text"
     />

     <flux:input
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
       wire:confirm="{{ __('Are you sure you want to delete this banner?') }}"
     >
       Eliminar
     </flux:button>
   </div>
 </flux:card>
