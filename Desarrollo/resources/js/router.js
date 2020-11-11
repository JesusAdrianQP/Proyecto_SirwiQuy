import Vue from "vue";
import VueRouter from "vue-router";

//Importaciones generales
import Index from "./pages/Index.vue";
import NotFound from "./pages/NotFound.vue";
import JoinUs from "./pages/JoinUs.vue";

//Importaciones de la carpeta Auth
import SignUpIndie from "./pages/Auth/SignUpIndie.vue";
import Login from "./pages/Auth/Login.vue";
import SignUpEnterprise from "./pages/Auth/SignUpEnterprise.vue";

//Importaciones de la carpeta cliente
import CustomerBlank from "./pages/Customer/Blank.vue";

//import { isElement } from "lodash";

//Importaciones de la carpeta Workers (solo pertenecientes a trabajadores independientes)
import EditProfile from "./pages/Worker/EditProfile.vue"; //Actualizar perfil solo es de trabajador

//Importaciones de la carpeta Suppliers (proveedores trabajadores y empresas en comun)
import Home from "./pages/Supplier/Home.vue";

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

//Verifica si son proveedores son los usuarios entrantes
const isSupplier = (to, from, next) => {
    if (
        localStorage.getItem("e_level") == "employee" || 
        localStorage.getItem("e_level") == "enterprise"
    ) {
        if (
            (localStorage.getItem("e_DNI") == undefined ||
                localStorage.getItem("e_DNI") == "") &&
            to.path != "/worker/profile/edit"
        ) {
            next("/worker/profile/edit");
            return;
            }
        next();
        return;
    }
    next("/login/employee");
};

//Verificador de usuario trabajador
const isWorker = (to, from, next) => {
    if (localStorage.getItem("e_level") == "employee") {
        next();
        return;
    }
    next("/login/employee");
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

        {
            path: "/signup/enterprise",
            component: SignUpEnterprise,
            beforeEnter: isGuest
        },

        //Ruta solo para trabajador
        {
            path: "/worker/profile/edit",
            component: EditProfile,
            beforeEnter: isWorker
        },

        //Rutas de los proveedores
        {
            path: "/supplier",
            component: Home,
            beforeEnter: isSupplier
        },
        
        //Ruta no registrada
        {
            path: "*",
            component: NotFound
        }
    ]
});
