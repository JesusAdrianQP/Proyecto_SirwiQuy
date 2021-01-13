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
import VueGeolocation from 'vue-browser-geolocation'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGeolocation);
Vue.use(VueToast);
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyAU0hG5XwO-j6cV7EG9KULziR9LCSmwrKo',
        libraries: "places"
    }
})

const app = new Vue({
    el: '#app',
    router
});
