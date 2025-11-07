import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// Importar el paquete completo de Bootstrap (JS)
import * as bootstrap from 'bootstrap';

// Opcional: hacerlo global
window.bootstrap = bootstrap;