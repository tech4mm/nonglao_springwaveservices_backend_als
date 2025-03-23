<x-filament::page>
    <form wire:submit.prevent="send">
        {{ $this->form }}

        <div class="mt-6">
            <x-filament::button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="notificationImage"
            >
                <span wire:loading.remove wire:target="notificationImage">
                    Send Notification
                </span>
                <span wire:loading wire:target="notificationImage">
                    Uploading Image...
                </span>
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
