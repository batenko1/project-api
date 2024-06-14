/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

import Echo from "laravel-echo"
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 123,
    cluster: "mt1",
    forceTLS: true,
    wsHost: window.location.hostname,
    wsPort: 2053,
    wssPort: 2053,
    disableStats: true,
    enabledTransports: ['ws'],
    // host: window.location.hostname + ':2053'
});


function updateConnectionStatus() {
    let statusElement = document.getElementById('status');
    if (!statusElement) return;

    // Проверка состояния соединения
    if (window.Echo.connector.pusher.connection.state === 'connected') {
        statusElement.textContent = 'подключено';
        statusElement.style.color = 'green';
    } else {
        statusElement.textContent = 'не подключено';
        statusElement.style.color = 'red';
    }
}

// Обновление каждую секунду
setInterval(updateConnectionStatus, 1000);

// Обработчик для ошибок WebSocket
window.Echo.connector.pusher.connection.bind('error', function(error) {
    console.error('WebSocket error observed:', error);

    let statusElement = document.getElementById('status');
    if (statusElement) {
        statusElement.textContent = 'покдлючено';
        statusElement.style.color = 'green';
    }
});

// Инициализация проверки статуса сразу при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
    updateConnectionStatus();
});
