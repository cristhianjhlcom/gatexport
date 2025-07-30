<x-mail::message>
  # Nueva Orden Generada

  Una nueva orden ha sido generada y requiere tu revisión.

  **ID de Orden:** {{ $order->id }}

  **Cliente:** {{ $order->customer_firstname }} {{ $order->customer_lastname }}

  **Email:** {{ $order->customer_email }}

  **Producto:** {{ $order->items()->first()->product->name }}

  Revisa la orden en la plataforma para más detalles.

  <x-mail::button :url="$url">
    Revisar Orden
  </x-mail::button>

  Gracias,<br>
  {{ config('app.name') }}
</x-mail::message>
