<div class="flex h-[900px] w-full bg-white rounded-xl shadow overflow-hidden">
    <!-- User List -->
    <div class="w-1/4 border-r overflow-y-auto">
        <div class="p-4 font-semibold border-b">Users</div>
        @foreach ($users as $user)
            <div wire:click="$set('receiverId', {{ $user->id }})"
                 class="cursor-pointer px-4 py-3 hover:bg-gray-100 {{ $receiverId === $user->id ? 'bg-blue-100 font-semibold' : '' }}">
                {{ $user->name }}
            </div>
        @endforeach
    </div>

    <!-- Chat Section -->
    <div class="w-3/4 flex flex-col">
        <div class="flex-1 overflow-y-auto p-4 space-y-2">
            @foreach ($messages as $message)
                @if ($message->sender_id === $authUserId)
                    <div class="flex justify-end">
                        <div class="bg-blue-500 text-white px-4 py-2 rounded-lg max-w-xs">
                            {{ $message->message }}
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="bg-gray-200 text-black px-4 py-2 rounded-lg max-w-xs">
                            {{ $message->message }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Message Input -->
        <div class="border-t p-4 flex items-center gap-2">
            <input type="text" wire:model.defer="newMessage"
                   wire:keydown.enter="sendMessage"
                   placeholder="Type your message..."
                   class="flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring focus:border-blue-300">
            <button wire:click="sendMessage"
                    class="bg-blue-600 text-black px-4 py-2 rounded-full hover:bg-blue-700">
                Send
            </button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('message-sent', event => {
            const chatContainer = document.querySelector('.flex-1');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
@endpush
@push('styles')
    <style>
        .chat-widget {
            max-height: 600px;
            overflow-y: auto;
        }
    </style>
@endpush
