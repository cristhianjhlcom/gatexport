@if (count($this->images) === 0)
  <div class="flex h-[400px] w-full items-center justify-center rounded-sm border border-gray-50 bg-gray-50">
    <h4 class="flex items-center gap-x-4 text-3xl font-bold text-gray-300">
      <flux:icon class="size-12" name="photo" />
      No Image
    </h4>
  </div>
@else
  <div class="space-y-4">
    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-sm border border-gray-400">
      <img
        alt="Featured Image"
        class="h-full w-full object-cover object-center"
        src="{{ Storage::disk('public')->url($this->selectedImage->path) }}"
      >
    </div>
    <div class="grid grid-cols-4 gap-4">
      @foreach ($this->images as $image)
        <button
          class="aspect-w-1 aspect-h-1 {{ $this->selectedImage->id === $image->id ? 'ring-1 ring-primary-500' : '' }} overflow-hidden rounded-sm border border-gray-400"
          type="button"
          wire:click="selectImage({{ $image }})"
        >
          <img
            alt="Gallery Image"
            class="h-full w-full cursor-pointer object-cover object-center hover:opacity-75"
            src="{{ Storage::disk('public')->url($image->path) }}"
          >
        </button>
      @endforeach
    </div>
  </div>
@endif
