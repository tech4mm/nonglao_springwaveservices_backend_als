<x-filament::page>
<div x-data="{ open: false }" @keydown.window.escape="open = false" >
     <!-- Mobile Sidebar -->
     <div class="fixed inset-0 z-40 flex md:hidden lg:hidden" x-show="open" x-transition>
            <!-- Backdrop -->
            <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-25"></div>

            <!-- Sidebar Content -->
            <div class="relative flex flex-col w-64 bg-white dark:bg-gray-900">
                <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                    <span class="text-lg font-semibold text-black dark:text-white">Users</span>
                    <button @click="open = false" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        ✖
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <input type="text" wire:model.debounce.300ms="search"
                        placeholder="Search users..."
                        class="w-full px-3 py-2 mb-4 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-black dark:text-white bg-white dark:bg-gray-900 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-blue-300" />
                    <div class="overflow-y-auto h-[calc(100vh-200px)]">
                        @foreach ($this->users as $user)
                            <div wire:click="$set('receiverId', {{ $user->id }})"
                                class="cursor-pointer px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center gap-3 {{ $receiverId === $user->id ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                                @if ($user->user_picture)
                                    <img src="{{ asset('storage/' . $user->user_picture) }}" 
                                        alt="User" class="w-10 h-10 rounded-full object-cover" />
                                @else
                                    <div class="w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-sm text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="flex flex-col">
                                    <span class="text-black dark:text-white">{{ $user->name }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->phone }}</span>
                                </div>
                                <span class="ml-auto text-xs bg-gray-200 dark:bg-gray-700 text-black dark:text-white rounded-full px-2 py-0.5">
                                    {{ $user->unread_count ?? 0 }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </div>
    <div class="bg-white dark:bg-gray-900 shadow ">
        <!-- Mobile Top Bar -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow md:hidden lg:hidden">
                    <button @click="open = true" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
                        ☰
                    </button>
                    <h1 class="text-lg font-semibold text-black dark:text-white">Chat</h1>
                    <div></div>
        </div>
        <div class="flex w-full h-[10vh] bg-white dark:bg-gray-900 shadow">
            <div class="flex h-screen w-full overflow-y-auto">

                <!-- User List Section -->
                <div class="hidden md:flex lg:flex flex flex-col w-40 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 overflow-y-auto">
                    <div class="flex flex-col items-center bg-indigo-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 mt-4 py-6 px-4 rounded-lg">
                        <div>
                            <div class="p-4 font-semibold border-b border-gray-200 dark:border-gray-700 text-black dark:text-white">Users</div>
                            <div class="p-2">
                                <input type="text" 
                                    wire:model.debounce.300ms="search"
                                    placeholder="Search users..."
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm text-black dark:text-white bg-white dark:bg-gray-900 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-blue-300" />
                            </div>
                            <div class="overflow-x-auto">
                                
                                 @foreach ($this->filteredUsers as $user)
                                    <div wire:click="$set('receiverId', {{ $user->id }})"
                                        class="cursor-pointer px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center gap-3 {{ $receiverId === $user->id ? 'bg-gray-200 dark:bg-gray-700 font-semibold' : '' }}">
                                        @if ($user->user_picture)
                                            <img src="{{ asset('storage/' . $user->user_picture) }}" 
                                                alt="User" 
                                                class="w-10 h-10 rounded-full object-cover" />
                                        @else
                                            <div class="w-10 h-10 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-sm text-white">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div class="flex flex-col">
                                            <span class="text-black dark:text-white">{{ $user->name }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $user->phone }}</span>
                                        </div>
                                        <span class="ml-auto text-xs bg-gray-200 dark:bg-gray-700 text-black dark:text-white rounded-full px-2 py-0.5">
                                            {{ $user->unread_count ?? 0 }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Section -->
                <div class="flex-1 bg-gray-100 dark:bg-gray-800 p-6 overflow-y-auto h-[10vh] border border-gray-300 dark:border-gray-600 border-r">
                    <!-- Messages Container -->
                    <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-lg ">
                        <div class="flex flex-col">
                            <div class="grid grid-cols-12 gap-y-2" wire:poll.1s>
                                <!-- Example Messages -->
                                @if($receiverId)
                                @foreach ($this->messages as $message)
                                @php
                                $cleanMessage = \Illuminate\Support\Str::replace('📎 File: ', '', $message->message);
                                    $fileLink = null;

                                    // Check if message contains a link
                                    if (Str::contains($cleanMessage, 'href=')) {
                                        preg_match('/href="(.*?)"/', $cleanMessage, $matches);
                                        $fileLink = $matches[1] ?? null;
                                    }
                                @endphp
                                @if ($message->sender_id !== $authUserId)
                                @php $sender = $this->users->firstWhere('id', $message->sender_id); @endphp
                                <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                    <div class="flex flex-row items-center">
                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                        @if ($sender && $sender->user_picture)
                                            <img src="{{ asset('storage/' . $sender->user_picture) }}" alt="User"
                                                class="w-8 h-8 rounded-full object-cover" />
                                        @else
                                            <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center text-xs text-white">
                                                {{ strtoupper(substr($sender->name ?? '?', 0, 1)) }}
                                            </div>
                                        @endif
                                        </div>
                                        <div class="relative ml-3 text-sm bg-white dark:bg-gray-900 py-2 px-4 shadow rounded-xl">
                                            @if ($fileLink)
                                                <div class="flex items-center gap-2">
                                                @if (Str::endsWith($fileLink, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    
                                                        <img src="{{ $fileLink }}" class="w-32 h-32 rounded-lg object-cover" />
                                                        
                                                @else
                                                    <iframe src="{{ $fileLink }}" class="w-32 h-32 rounded-lg" frameborder="0"></iframe>
                                                @endif
                                                    <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                        class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                        title="Download">
                                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                                <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                            </svg>
                                                    </a>
                                                    
                                                </div>
                                            @elseif (Str::contains($message->message, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <div class="flex items-center gap-2">
                                                    <img src="{{ $message->message }}" class="w-32 h-32 rounded-lg object-cover" />
                                                    
                                                    <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                    class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                    title="Download">
                                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                        </svg>
                                                    </a>
                                                </div>

                                            @elseif (Str::contains($message->message, ['.pdf', '.csv', '.xls', '.xlsx', '.doc', '.docx']))
                                                <iframe src="{{ $message->message }}" class="w-32 h-32 rounded-lg" frameborder="0"></iframe>
                                                <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                    class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                    title="Download">
                                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                        </svg>
                                                </a>
                                            @else
                                                <div>{{ $message->message }}</div>
                                            @endif
                                            <div class="text-xs mt-1 text-right text-gray-500 dark:text-gray-400 flex items-center justify-end gap-1">
                                                <span>{{ $message->created_at->format('H:i') }}</span>
                                                @if($message->is_read)
                                                    <x-heroicon-s-check class="w-4 h-4 text-green-500" />
                                                @else
                                                    <x-heroicon-s-check class="w-4 h-4 text-gray-400 dark:text-gray-400" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-start-6 col-end-13 p-3 rounded-lg">
                                    <div class="flex items-center justify-start flex-row-reverse">
                                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                            <x-heroicon-o-user-circle class="w-6 h-6 text-blue-700" />
                                        </div>
                                        <div class="relative mr-3 text-sm bg-indigo-100 dark:bg-gray-800 py-2 px-4 shadow rounded-xl">
                                            @if ($fileLink)
                                                <div class="flex items-center gap-2">
                                                @if (Str::endsWith($fileLink, ['.jpg', '.jpeg', '.png', '.gif']))
                                                    
                                                        <img src="{{ $fileLink }}" class="w-32 h-32 rounded-lg object-cover" />
                                                        
                                                @else
                                                    <iframe src="{{ $fileLink }}" class="w-32 h-32 rounded-lg" frameborder="0"></iframe>
                                                @endif
                                                    <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                        class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                        title="Download">
                                                            <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                                <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                            </svg>
                                                    </a>
                                                    
                                                </div>
                                            @elseif (Str::contains($message->message, ['.jpg', '.jpeg', '.png', '.gif']))
                                            <div class="flex items-center gap-2">
                                                    <img src="{{ $message->message }}" class="w-32 h-32 rounded-lg object-cover" />
                                                    
                                                    <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                    class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                    title="Download">
                                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @elseif (Str::contains($message->message, ['.pdf', '.csv', '.xls', '.xlsx', '.doc', '.docx']))

                                                <iframe src="{{ $message->message }}" class="w-32 h-32 rounded-lg" frameborder="0"></iframe>
                                                <a href="{{ route('download.file', ['url' => $message->message]) }}" 
                                                    class="flex items-center justify-center p-2 bg-gray-100 dark:bg-gray-800 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
                                                    title="Download">
                                                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current text-gray-700 dark:text-gray-300">
                                                            <path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                                        </svg>
                                                </a>
                                            @else
                                                <div>{{ $message->message }}</div>
                                            @endif
                                            <div class="text-xs mt-1 text-right text-gray-500 dark:text-gray-400 flex items-center justify-end gap-1">
                                                <span>{{ $message->created_at->format('H:i') }}</span>
                                                @if($message->is_read)
                                                    <x-heroicon-s-check class="w-4 h-4 text-green-500" />
                                                @else
                                                    <x-heroicon-s-check class="w-4 h-4 text-gray-400 dark:text-gray-400" />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                                <!-- Add more messages here -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Message Input -->
        <div class="sticky bottom-0 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 p-4">
            <div class="flex items-center h-16 rounded-xl bg-white dark:bg-gray-900 w-full px-4">
                <label class="cursor-pointer bg-gray-100 dark:bg-gray-800 px-3 py-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 text-sm text-gray-700 dark:text-gray-300">
                    📎
                    <input type="file" class="hidden" wire:model="file" wire:change="uploadFile">
                </label>
                <div class="flex-grow ml-4">
                    <div class="relative w-full">
                        <input type="text" 
                            wire:model.defer="newMessage"
                            wire:keydown.enter="sendMessage"
                            placeholder="Type your message..."
                            class="flex w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full text-black dark:text-white bg-white dark:bg-gray-900 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring focus:ring-blue-500 dark:focus:ring-blue-500 focus:border-blue-300">
                    </div>
                </div>
                <div class="ml-4">
                    <button wire:click="sendMessage"
                        class="bg-blue-600 p-2 rounded-full hover:bg-blue-700 transition duration-150"
                        title="Send">
                        <!-- <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg> -->
                        ==>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</x-filament::page>
