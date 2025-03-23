<x-filament::page>
    <form wire:submit.prevent="send">
        {{ $this->form }}

        <div class="mt-6"> {{-- Add margin-top here --}}
            <x-filament::button type="submit">
                Send Notification
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
