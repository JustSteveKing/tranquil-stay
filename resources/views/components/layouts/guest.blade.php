@props(['title' => config('app.name'), 'heading' => null])

<x-layouts.page title="{{ $title }}">
    <div class="flex min-h-full flex-1 flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-10 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600" alt="Your Company">
            <x-text.h2 class="mt-6 text-center">
                {{ $heading ?? $title }}
            </x-text.h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
            {{ $slot }}
        </div>
    </div>
</x-layouts.page>
