<div class="space-y-4">
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

    <!-- General Settings -->
    @include('livewire.admin.settings.partials.general-info')

    <!-- Carousel/Banners -->
    @include('livewire.admin.settings.partials.banners')

    <!-- Providers -->
    <section class="space-y-4">
      <header class="mb-4 flex items-center justify-between">
        <flux:heading level="2" size="lg">{{ __('Providers') }}</flux:heading>
        <flux:button
          size="sm"
          variant="outline"
          wire:click="addProvider"
        >
          {{ __('Add Provider') }}
        </flux:button>
      </header>
      <main class="space-y-4">
        @foreach ($providers as $index => $provider)
          <div class="grid gap-4 sm:grid-cols-2">
            <flux:input
              label="{{ __('Title') }}"
              placeholder="Lorem Ipsum.."
              wire:model="providers.{{ $index }}.title"
            />
            <flux:input
              label="{{ __('Image') }}"
              type="file"
              wire:model="providers.{{ $index }}.image"
            />
            <flux:button
              class="sm:col-span-2"
              variant="danger"
              wire:click="removeProvider({{ $index }})"
            >
              {{ __('Remove Provider') }}
            </flux:button>
          </div>
        @endforeach
      </main>
    </section>

    <!-- About Us -->
    <section class="space-y-4">
      <header>
        <flux:heading level="2" size="lg">{{ __('About Us') }}</flux:heading>
      </header>
      <main class="space-y-4">
        <div class="grid gap-4">
          <flux:editor
            label="{{ __('Company History') }}"
            placeholder="Lorem Ipsum..."
            wire:model="aboutUs.history"
          />
          <flux:input
            label="{{ __('Main Image') }}"
            type="file"
            wire:model="newAboutImage"
          />
          <flux:editor
            label="{{ __('Vision') }}"
            placeholder="Lorem Ipsum.."
            wire:model="aboutUs.vision"
          />
          <flux:editor
            label="{{ __('Mission') }}"
            placeholder="Lorem Ipsum..."
            wire:model="aboutUs.mission"
          />
        </div>
      </main>
    </section>

    <!-- Export Countries -->
    <section class="space-y-4">
      <header class="mb-4">
        <flux:heading>{{ __('Export Countries') }}</flux:heading>
      </header>
      <main>
        <flux:select
          label="{{ __('Countries') }}"
          multiple
          placeholder="{{ __('Add a country') }}"
          placeholder="Choose industries..."
          variant="listbox"
          wire:model="exportCountries.countries"
        >
          @foreach ($exportCountriesList as $country)
            <flux:select.option>{{ $country['name'] }}</flux:select.option>
          @endforeach
        </flux:select>
      </main>
    </section>

    <!-- Contact Information -->
    <section class="space-y-4">
      <header>
        <flux:heading level="2" size="lg">{{ __('Contact Information') }}</flux:heading>
      </header>
      <main class="divide-y-1 space-y-4 divide-gray-200">

        <!-- Phone Numbers -->
        <section class="space-y-4">
          <header class="mb-4 flex items-center justify-between">
            <flux:heading level="3">{{ __('Phone Numbers') }}</flux:heading>
            <flux:button
              size="sm"
              variant="outline"
              wire:click="addPhone"
            >
              {{ __('Add Phone') }}
            </flux:button>
          </header>
          <main class="space-y-4">
            @foreach ($phones as $index => $phone)
              <div class="grid gap-4 sm:grid-cols-2">
                <flux:input
                  label="{{ __('Phone') }}"
                  mask="(+51) 999 999 999"
                  placeholder="{{ __('Add a phone number') }}"
                  type="tel"
                  wire:model="contactInfo.phones.{{ $index }}"
                />
                <flux:button
                  class="sm:col-span-2"
                  variant="danger"
                  wire:click="removePhone({{ $index }})"
                >
                  {{ __('Remove Phone') }}
                </flux:button>
              </div>
            @endforeach
          </main>
        </section>

        <!-- Email Addresses -->
        <section class="space-y-4">
          <header class="mb-4 flex items-center justify-between">
            <flux:heading level="3">{{ __('Email Addresses') }}</flux:heading>
            <flux:button
              size="sm"
              variant="outline"
              wire:click="addEmail"
            >
              {{ __('Add Email') }}
            </flux:button>
          </header>
          <main class="space-y-4">
            @foreach ($emails as $index => $email)
              <div class="grid gap-4 sm:grid-cols-2">
                <flux:input
                  label="{{ __('Email Addresses') }}"
                  placeholder="{{ __('Add an email') }}"
                  type="email"
                  wire:model="contactInfo.emails.{{ $index }}"
                />
                <flux:button
                  class="sm:col-span-2"
                  variant="danger"
                  wire:click="removeEmail({{ $index }})"
                >
                  {{ __('Remove Phone') }}
                </flux:button>
              </div>
            @endforeach
          </main>
        </section>

        <!-- Addresses -->
        <section class="space-y-4">
          <header class="mb-4 flex items-center justify-between">
            <flux:heading level="3">{{ __('Addresses') }}</flux:heading>
            <flux:button
              size="sm"
              variant="outline"
              wire:click="addAddress"
            >
              {{ __('Add Address') }}
            </flux:button>
          </header>
          <main class="space-y-4">
            @foreach ($addresses as $index => $address)
              <div class="grid gap-4 sm:grid-cols-2">
                <flux:input
                  label="{{ __('Addresses') }}"
                  placeholder="{{ __('Add an address') }}"
                  wire:model="contactInfo.addresses.{{ $index }}"
                />
                <flux:button
                  class="sm:col-span-2"
                  variant="danger"
                  wire:click="removeAddress({{ $index }})"
                >
                  {{ __('Remove Address') }}
                </flux:button>
              </div>
            @endforeach
          </main>
        </section>

        <!-- Social Media -->
        <section class="space-y-4">
          <header class="mb-4 flex items-center justify-between">
            <flux:heading level="3">{{ __('Social Medias') }}</flux:heading>
            <flux:button
              size="sm"
              variant="outline"
              wire:click="addSocialMedia"
            >
              {{ __('Add Social Media') }}
            </flux:button>
          </header>
          <main class="space-y-4">
            @foreach ($socialMedias as $index => $socialMedia)
              <div class="grid gap-4 sm:grid-cols-2">
                <flux:input
                  label="Social Media Link"
                  placeholder="https://facebook.com"
                  wire:model="contactInfo.social_medias.{{ $index }}.link"
                />
                <flux:input
                  label="Social Media Name"
                  placeholder="Facebook"
                  wire:model="contactInfo.social_medias.{{ $index }}.name"
                />
              </div>
              <flux:input type="file" wire:model="contactInfo.social_medias.{{ $index }}.icon" />
              <flux:button
                class="sm:col-span-2"
                variant="danger"
                wire:click="removeSocialMedia({{ $index }})"
              >
                {{ __('Social Media') }}
              </flux:button>
            @endforeach
          </main>
        </section>

      </main>
    </section>

  </div>
  <!-- Save Button -->
  <flux:separator />

  <div>
    <flux:button variant="primary" wire:click="save">
      {{ __('Save Settings') }}
    </flux:button>
  </div>
</div>
