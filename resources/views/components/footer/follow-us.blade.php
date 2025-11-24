@props(['general_information'])

<div class="flex items-center gap-x-4">
  <x-common.title class="text-center" level="2" size="title" variant="white" weight="font-extrabold">
    {{ __('layouts.footer.follow_us') }}
  </x-common.title>

  <div class="flex space-x-4 text-gray-400">
    <x-footer.social-link :url="$general_information['social_media']['facebook']" label="Facebook">
      <x-icon.facebook class="size-10" fill="#fff" />
    </x-footer.social-link>
    <x-footer.social-link :url="$general_information['social_media']['linkedin']" label="LinkedIn">
      <x-icon.linkedin class="size-10" fill="#fff" />
    </x-footer.social-link>
    <x-footer.social-link :url="$general_information['social_media']['youtube']" label="YouTube">
      <x-icon.youtube class="size-10" fill="#fff" />
    </x-footer.social-link>
  </div>
</div>
