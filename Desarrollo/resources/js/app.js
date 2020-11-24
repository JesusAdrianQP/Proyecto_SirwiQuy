/**
 * Proyecto elaborado para el curso de Gestión, proyecto SPA
 * Todos los componentes y scripts son registrados e importados de forma
 *  general - Team SirwiQuy
 */

window.Vue = require('vue');

/**
 * Importaciones de Vue JS
 */
import router from './router'
import VueToast from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'

Vue.use(VueToast);

const app = new Vue({
    el: '#app',
    router
});
