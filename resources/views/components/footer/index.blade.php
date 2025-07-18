<footer class="bg-gray-900 py-8 text-white">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-4">
      <!-- Logo and Description -->
      <div class="col-span-1 lg:col-span-2">
        <img
          alt="Company Logo"
          class="mb-4 h-12"
          src="{{ $company_logos['large_logo'] }}"
        />
        <p class="mb-4 text-gray-400">
          {{ $general_information['translations']['company_short_description'] }}
        </p>
      </div>

      <!-- Address -->
      <div>
        <h3 class="mb-4 text-lg font-semibold">
          {{ __('Address') }}
        </h3>
        <address class="not-italic text-gray-400">
          <p>Calle Principal #123</p>
          <p>Colonia Centro</p>
          <p>Ciudad, Estado CP 12345</p>
        </address>
      </div>

      <!-- Contact Information -->
      <div>
        <h3 class="mb-4 text-lg font-semibold">
          {{ __('Contact Information') }}
        </h3>
        <div class="text-gray-400">
          <p class="mb-2">
            <i class="fas fa-phone mr-2"></i>
            <a class="hover:text-white" href="tel:+123456789">
              +52 (123) 456-7890
            </a>
          </p>
          <p>
            <i class="fas fa-envelope mr-2"></i>
            <a class="hover:text-white" href="mailto:contacto@empresa.com">
              contacto@empresa.com
            </a>
          </p>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="mt-8 border-t border-gray-800 pt-8 text-center text-gray-400">
      <p>&copy; {{ date('Y') }} {{ $general_information['translations']['company_name'] }}. Todos los derechos
        reservados.</p>
    </div>
  </div>
</footer>
