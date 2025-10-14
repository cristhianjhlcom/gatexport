<div>
  <!-- Follow Us -->
  <div class="bg-primary-500 py-4 text-white">
    <div class="container mx-auto flex items-center gap-x-4 px-4">
      <x-common.title
        class="text-center"
        level="2"
        size="title"
        variant="white"
        weight="font-extrabold"
      >
        {{ __('layouts.footer.follow_us') }}
      </x-common.title>
      <div class="flex space-x-4 text-gray-400">
        @if (!empty($general_information['social_media']['facebook']))
          <a
            aria-label="Facebook"
            class="text-white"
            href="{{ $general_information['social_media']['facebook'] }}"
          >
            <svg
              class="h-10 w-10"
              fill="currentColor"
              viewBox="0 0 448 512"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"
              />
            </svg>
          </a>
        @endif

        @if (!empty($general_information['social_media']['linkedin']))
          <a
            aria-label="LinkedIn"
            class="text-white"
            href="{{ $general_information['social_media']['linkedin'] }}"
          >
            <svg
              class="h-10 w-10"
              fill="currentColor"
              viewBox="0 0 448 512"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
              />
            </svg>
          </a>
        @endif

        @if (!empty($general_information['social_media']['youtube']))
          <a
            aria-label="YouTube"
            class="text-white"
            href="{{ $general_information['social_media']['youtube'] }}"
          >
            <svg
              class="h-10 w-10"
              fill="currentColor"
              viewBox="0 0 448 512"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M282 256.2l-95.2-54.1V310.3L282 256.2zM384 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64zm14.4 136.1c7.6 28.6 7.6 88.2 7.6 88.2s0 59.6-7.6 88.1c-4.2 15.8-16.5 27.7-32.2 31.9C337.9 384 224 384 224 384s-113.9 0-142.2-7.6c-15.7-4.2-28-16.1-32.2-31.9C42 315.9 42 256.3 42 256.3s0-59.7 7.6-88.2c4.2-15.8 16.5-28.2 32.2-32.4C110.1 128 224 128 224 128s113.9 0 142.2 7.7c15.7 4.2 28 16.6 32.2 32.4z"
              />
            </svg>
          </a>
        @endif
      </div>
    </div>
  </div>

  <footer class="bg-primary-600 py-8 text-white">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
        <!-- Logo and Description -->
        <div class="col-span-1 flex flex-col justify-center space-y-4 text-center lg:col-span-2">
          <img
            alt="Gate Export"
            class="mx-auto h-12"
            src="{{ $company_logos['large_logo'] ?? asset('default-logo.png') }}"
          />

          <x-common.separator-line
            class="mx-auto w-full"
            color="border-white"
            pointColor="bg-white"
          />

          @if (!empty($general_information['translations']['company_short_description']))
            <p class="mb-4 text-gray-400">
              {{ $general_information['translations']['company_short_description'] }}
            </p>
          @endif
        </div>

        <!-- Address -->
        @if (!empty($general_information['contact_information']['address']))
          <div class="space-y-4">

            <div>
              <h3 class="mb-4 text-lg font-semibold">
                {{ __('layouts.footer.address') }}
              </h3>

              <address class="flex items-center gap-x-2 not-italic text-gray-400">
                <flux:icon name="map-pin" />
                <p>{{ $general_information['contact_information']['address'] }}</p>
              </address>
            </div>

            <!-- Contact Information -->
            <div>
              <h3 class="mb-4 text-lg font-semibold">
                {{ __('layouts.footer.contact_information') }}
              </h3>
              <div class="space-y-4 text-gray-400">
                @if (!empty($general_information['contact_information']['phone']))
                  <p class="flex items-center gap-x-2">
                    <flux:icon name="device-phone-mobile" />
                    <span>{{ $general_information['contact_information']['phone'] }}</span>
                  </p>
                @endif
                @if (!empty($general_information['contact_information']['second_phone']))
                  <p class="flex items-center gap-x-2">
                    <flux:icon name="device-phone-mobile" />
                    {{ $general_information['contact_information']['second_phone'] }}
                  </p>
                @endif
                @if (!empty($general_information['contact_information']['email']))
                  <p class="flex items-center gap-x-2">
                    <flux:icon name="envelope" />
                    {{ $general_information['contact_information']['email'] ?? 'email@example.com' }}
                  </p>
                @endif
              </div>
            </div>

          </div>
        @endif

        <div>

        </div>
      </div>

      <!-- Copyright -->
      {{-- <div class="mt-8 border-t border-gray-800 pt-8 text-center text-gray-400">
        <p>
          <span>&copy; {{ date('Y') }}</span>
          <span>{{ $general_information['translations']['company_name'] ?? config('app.name') }}.</span>
          <span>{{ __('layouts.footer.copyright') }}</span>
        </p>
      </div> --}}
    </div>
  </footer>
</div>
