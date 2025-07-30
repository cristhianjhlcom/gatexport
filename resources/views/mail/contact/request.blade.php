<x-mail::message>
  Hola,

  {{ $name }} ({{ $email }}) acaba de contactar con nosotros.

  {{ $message }}

  Gracias,<br>
  {{ config('app.name') }}
</x-mail::message>
