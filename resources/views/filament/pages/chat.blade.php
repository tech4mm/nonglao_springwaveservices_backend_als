<x-filament::page>
    <div class="flex w-full h-[600px] bg-white shadow overflow-hidden">
        <!-- User List -->
        <div class="w-1/3 border-r">
            <div>
            <div class="p-4 font-semibold border-b">Users</div>
            <div class="p-2">
                <input type="text" wire:model.debounce.300ms="search"
                       placeholder="Search users..."
                       class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring focus:border-blue-300" />
            </div>
            @foreach ($this->users as $user)
                <div wire:click="$set('receiverId', {{ $user->id }})"
                     class="cursor-pointer px-4 py-3 hover:bg-gray-100 flex items-center gap-3 {{ $receiverId === $user->id ? 'bg-blue-100 font-semibold' : '' }}">
                    @if ($user->user_picture)
                        <img src="{{ asset('storage/' . $user->user_picture) }}" alt="User" class="w-10 h-10 rounded-full object-cover" />
                    @else
                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-sm text-white">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span>{{ $user->name }}</span>
                        <span class="text-xs text-gray-500">{{ $user->email }}</span>
                        <span class="text-xs text-gray-500">{{ $user->phone }}</span>
                    </div>
                    <span class="ml-auto text-xs bg-gray-200 text-black rounded-full px-2 py-0.5">
                        {{ $user->unread_count ?? 0 }}
                    </span>
                </div>
            @endforeach
            </div>

        </div>

        <!-- Chat Section -->
        <div class="flex flex-col flex-1 h-full overflow-hidden">
            <!-- Message List -->
            <div class="overflow-y-auto p-4 space-y-2 flex-1" wire:poll.1s>
                @foreach ($this->messages as $message)
                    @if ($message->sender_id === $authUserId)
                        <div class="flex items-start gap-2 justify-end">
                            <div class="bg-blue-800 text-black font-bold px-4 py-2 rounded-lg max-w-xs">
                                {{ $message->message }}
                                <div class="text-xs mt-1 text-right text-gray-500 flex items-center justify-end gap-1">
                                    <span>{{ $message->created_at->format('H:i') }}</span>
                                    @if($message->is_read)
                                        <x-heroicon-s-check class="w-4 h-4 text-green-500" />
                                    @else
                                        <x-heroicon-s-check class="w-4 h-4 text-gray-400" />
                                    @endif
                                </div>
                            </div>
                            <x-heroicon-o-user-circle class="w-6 h-6 text-blue-700" />
                        </div>
                    @else
                        @php $sender = $this->users->firstWhere('id', $message->sender_id); @endphp
                        <div class="flex items-start gap-2 justify-start">
                            @if ($sender && $sender->user_picture)
                                <img src="{{ asset('storage/' . $sender->user_picture) }}" alt="User"
                                     class="w-8 h-8 rounded-full object-cover" />
                            @else
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs text-white">
                                    {{ strtoupper(substr($sender->name ?? '?', 0, 1)) }}
                                </div>
                            @endif

                            <div class="bg-gray-200 text-black px-4 py-2 rounded-lg max-w-xs">
                                {{ $message->message }}
                                <div class="text-xs mt-1 text-right flex items-center justify-end gap-1">
                                    <span class="text-gray-300">{{ $message->created_at->format('H:i') }}</span>
                                    @if($message->is_read)
                                        <x-heroicon-s-check class="w-4 h-4 text-green-300" />
                                    @else
                                        <x-heroicon-s-check class="w-4 h-4 text-gray-300" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
            <!-- Input Bar -->
            <div class="fixed bottom-0 left-1/3 w-2/3 bg-white p-4 rounded-xl shadow-md border border-gray-200 flex flex-wrap items-center gap-2 z-10">
                <!-- File Upload Button -->
                <label class="cursor-pointer bg-gray-100 px-3 py-2 rounded-full hover:bg-gray-200 text-sm text-gray-700">
                    📎
                    <input type="file" class="hidden" wire:model="file" wire:change="uploadFile" />
                </label>

                <!-- Message Input -->
                <input type="text" wire:model.defer="newMessage"
                    wire:keydown.enter="sendMessage"
                    placeholder="Type your message..."
                    class="flex-1 px-4 py-2 border rounded-full focus:outline-none focus:ring focus:border-blue-300">

                <!-- Send Notification Button -->
                {{-- <button wire:click="sendNotification"
                        class="bg-yellow-400 text-black px-4 py-2 rounded-full hover:bg-yellow-500">
                    🔔
                </button> --}}

                <button wire:click="sendMessage"
                    class="bg-blue-600 text-black p-2 rounded-full hover:bg-blue-700 transition duration-150"
                    title="Send">
                    <x-heroicon-s-paper-airplane class="w-5 h-5 transform rotate-45" />
                </button>
            </div>
</x-filament::page>
