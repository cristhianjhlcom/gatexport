 <flux:card class="space-y-4">

   <flux:input
     badge="{{ __('Required') }}"
     label="Provider Name"
     placeholder="Gate Export"
     wire:model="providers.{{ $index }}.name"
   />

   <flux:separator />

   @include('livewire.admin.settings.partials.provider-image')

   <div class="flex justify-end">
     <flux:button
       class="absolute right-0 top-0 z-10"
       icon:trailing="x-mark"
       size="sm"
       variant="danger"
       wire:click="remove({{ $index }})"
       wire:confirm="{{ __('Are you sure you want to delete this provider?') }}"
     >
       Eliminar
     </flux:button>
   </div>
 </flux:card>
