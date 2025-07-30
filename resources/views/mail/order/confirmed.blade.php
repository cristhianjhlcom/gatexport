<x-mail::message>
  # Confirmación de Pedido

  Hola {{ $order->customer_firstname }},

  Gracias por tu pedido. Aquí están los detalles:

  **Producto:** {{ $order->items()->first()->product->name }}

  Revisaremos y procesaremos tu pedido a la brevedad.

  Gracias por confiar en nosotros.

  Saludos,<br>
  {{ config('app.name') }}
</x-mail::message>
