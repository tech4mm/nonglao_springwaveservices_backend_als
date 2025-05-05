import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
    authEndpoint:  '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
        },
        withCredentials: true
    }
});

const userId = document.querySelector('meta[name="user-id"]')?.content;

window.Echo.private(`chat.${userId}`)
    .listen('.message.sent', (e) => {
        console.log('Private message received:', e.message);
        const messageSpan = document.getElementById('show-message');
        if (messageSpan) {
            const file = '/audio/audio.mp3';
            const audio = new Audio(file);
            audio.play();
            messageSpan.innerHTML = `
            <div id="message-container" class="mt-1 mr-6 p-4 text-sm rounded-lg shadow-lg transform transition-all duration-300 ease-in-out">
                <span class="font-medium">${e.message.message}</span>
            </div>
        `;

            // Auto-hide after 7 seconds
            setTimeout(() => {
                messageSpan.innerHTML = ''; 
            }, 7000);
        }
    });
