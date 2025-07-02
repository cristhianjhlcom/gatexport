@props(['form' => null])

<flux:card class="space-y-4">
  <flux:field>
    <flux:label>{{ __('Image') }}</flux:label>
    <flux:description>
      {{ __('Formats: PNG, JPG, WebP - Max dimensions: 1000x1000 (1:1) - Max size: 4.5 MB') }}
    </flux:description>
    <div class="dropzone w-full rounded border-2 border-dashed bg-gray-400" id="category-dropzone"></div>
    <flux:error name="form.image" />
  </flux:field>
</flux:card>

@script
  <script>
    Dropzone.autoDiscover = false;

    const dropzone = new Dropzone("#category-dropzone", {
      url: "{{ route('admin.images.upload') }}",
      maxFilesize: 4.5,
      maxFiles: 1,
      acceptedFiles: ".png,.jpg,.jpeg,.webp",
      addRemoveLinks: true,
      dictDefaultMessage: "Drop files here or click to upload.",
      dictRemoveFile: "Remove file",
      headers: {
        "X-CSRF-TOKEN": document
          .querySelector("meta[name='csrf-token']")
          .getAttribute("content"),
      },
      init: function() {
        console.log('init');
      },
    });

    dropzone.on("success", function(file, response) {
      Livewire.dispatch("imageUploaded", {
        image: response,
      });

      file.serverFileName = response.filename;
    });

    dropzone.on("error", function(file, errorMessage, xhr) {
      console.log(errorMessage);
    });

    dropzone.on("removedfile", function(file) {

    });
  </script>
@endscript
