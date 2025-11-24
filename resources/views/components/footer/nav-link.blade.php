@props(['url', 'isActive' => false])

<a {{ $attributes->class([
    'bg-primary-50 text-primary-400' => $isActive,
    'bg-primary-500 text-white' => !$isActive,
    'text-md block h-20 place-content-center px-4 font-extrabold underline',
]) }} href="{{ $url }}">{{ $slot }}</a>
