@props([
    'link' => '',
])

<a aria-label="Chat on WhatsApp"
  class="animation-pulse transition-background-color fixed bottom-4 right-4 z-50 animate-pulse rounded-full bg-[#25d366] p-2 text-white shadow-lg hover:bg-[#128c7e]"
  href="{{ $link }}" target="_blank">
  <x-icon.whatsapp fill="#fff" class="size-10" />
</a>

<style>
  .animation-pulse {
    transform: scale(0.8);
    */ animation: pulse 2s infinite;
  }

  @keyframes pulse {
    0% {
      transform: scale(0.9);
      box-shadow: 0 0 0 0 #25d366;
    }

    70% {
      transform: scale(1);
      box-shadow: 0 0 0 20px rgba(229, 62, 62, 0);
    }

    100% {
      transform: scale(0.9);
    }
  }
</style>
