import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});

// Panggil Laravel Echo agar bisa menangkap event broadcast
window.Echo.channel('room-channel')
    .listen('.room.joined', (event) => {
        // Tambahkan peserta ke dalam daftar
        addParticipant(event.username);
    });


