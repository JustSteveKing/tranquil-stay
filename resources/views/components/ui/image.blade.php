@props(['src','alt'])

<img
    {!! $attributes->merge(['class' => 'mx-auto w-auto']) !!}
    src="{{ $src }}"
    alt="{{ $alt }}"
/>
