{{-- resources/views/layouts/panel.blade.php --}}

<x-filament::layout>
    <x-slot name="sidebar">
        <div
            x-data="{ open: false }"
            x-init="
                window.addEventListener('toggle-sidebar', () => {
                    open = !open;
                });
            "
            x-show="open"
            x-cloak
            class="fixed inset-y-0 left-0 z-30 w-64 bg-white dark:bg-gray-800 transform -translate-x-full transition-all"
            :class="{ 'translate-x-0': open }"
        >
            {{ $sidebar }}
        </div>
    </x-slot>

    <x-slot name="header">
        <button
            x-data
            x-on:click="$dispatch('toggle-sidebar')"
            class="text-sm font-semibold px-4 py-2 bg-primary-600 text-white rounded-md"
        >
            Toggle Menu
        </button>

        {{ $header }}
    </x-slot>

    {{ $slot }}
</x-filament::layout>
