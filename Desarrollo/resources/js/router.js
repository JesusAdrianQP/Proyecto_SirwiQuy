import Vue from "vue";
import VueRouter from "vue-router";

//Importaciones generales
import Index from "./pages/Index.vue";
import NotFound from "./pages/NotFound.vue";
import JoinUs from "./pages/JoinUs.vue";

//Importaciones de la carpeta Auth
import SignUpIndie from "./pages/Auth/SignUpIndie.vue";
import Login from "./pages/Auth/Login.vue";

//Importaciones de la carpeta cliente
import CustomerBlank from "./pages/Customer/Blank.vue";

import { isElement } from "lodash";


//Verifica si el visitante no posee id o es un cliente logeado
const isUnique = (to, from, next) => {
    if (
        localStorage.getItem("e_id") == null ||
        localStorage.getItem("e_level") == "customer"
    ) {
        next();
        return;
    }
    next("/supplier");
};

//Verifica si un usuario esta como visitante
const isGuest = (to, from, next) => {
    if (localStorage.getItem("e_id") == null) {
        next();
        return;
    }
    next("/");
};

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: "/", //Ruta para el index de la página
            component: Index,
            beforeEnter: isUnique
        },
        {
            path: "/customer/blank", //Ruta en construcción
            component: CustomerBlank,
            beforeEnter: isUnique
        },
        //Ruta para clientes y trabajador no logueados
        {
            path: "/join_us",
            component: JoinUs,
            beforeEnter: isGuest
        },

        {
            path: "/login/:identity",
            component: Login,
            beforeEnter: isGuest,
            props: true
        },

        {
            path: "/signup/indie/:identity",
            component: SignUpIndie,
            beforeEnter: isGuest,
            props: true
        },

        //Ruta no registrada
        {
            path: "*",
            component: NotFound
        }
    ]
});
