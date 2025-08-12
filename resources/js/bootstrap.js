import axios from 'axios';

// Certifique-se que window.Echo já está definido aqui

if (window.Echo) {
  axios.defaults.headers.common['X-Socket-Id'] = window.Echo.socketId();
  
  // Opcional: Atualiza o X-Socket-Id a cada vez que o socketId mudar (ex: reconnect)
  window.Echo.connector.socket.on('connect', () => {
    axios.defaults.headers.common['X-Socket-Id'] = window.Echo.socketId();
  });
}
