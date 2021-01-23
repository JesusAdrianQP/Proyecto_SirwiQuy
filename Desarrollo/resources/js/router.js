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
import RecoverSession from './pages/Auth/RecoverSession.vue';

//Importaciones de la carpeta Suppliers (proveedores trabajadores y empresas en comun)
import Home from "./pages/Supplier/Home.vue";
import NotificationDetails from "./pages/Supplier/NotificationDetails.vue";
import CreateService from "./pages/Supplier/CreateService.vue";
import CreatePrice from "./pages/Supplier/CreatePrice.vue";
import ServiceList from "./pages/Supplier/ServiceList.vue";
import UpdateService from "./pages/Supplier/UpdateService.vue";
import UpdatePrice from "./pages/Supplier/UpdatePrice.vue";
import SuppliersBlank from "./pages/Supplier/Blank.vue";
import Notifications from "./pages/Supplier/Notifications.vue";
import SatisfactionReport from './pages/supplier/SatisfactionReport.vue';

//Importaciones de la carpeta cliente
import CustomerBlank from "./pages/Customer/Blank.vue";
import ServiceCost from "./pages/Customer/ServiceCost.vue";
import ServiceDetails from "./pages/Customer/ServiceDetails.vue";
import ServiceReport from "./pages/Customer/ServiceReport.vue";
import ServiceForm from "./pages/Customer/ServiceForm.vue";
import RateService from "./pages/Customer/RateService.vue";
import Payment from "./pages/Customer/Payment.vue";

//Importaciones de la carpeta Workers (solo pertenecientes a trabajadores independientes)
import EditProfile from "./pages/Worker/EditProfile.vue";

import { isElement } from "lodash";

//Verifica si el visitante no posee id o es un cliente logeado
const isUnique = (to, from, next) => {
    if (
        localStorage.getItem("e_level") == null ||
        localStorage.getItem("e_level") == "customer"
    ) {
        next();
        return;
    }
    next("/supplier");
};

//Verifica si un usuario esta como visitante
const isGuest = (to, from, next) => {
    if (localStorage.getItem("e_level") == null) {
        next();
        return;
    }
    next("/");
};

//Verifica si son proveedores son los usuarios entrantes
const isSupplier = (to, from, next) => {
    if (
        localStorage.getItem("e_level") == "employee"
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
    }else if(
        localStorage.getItem("e_level") == "enterprise"
    ){
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

//Verificador de usuario cliente
const isCustomer = (to, from, next) => {
    if (localStorage.getItem("e_level") == "customer") {
        next();
        return;
    }
    next("/login/customer");
};

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        //Ruta para clientes y trabajador no logueados
        {
            path: "/",
            component: Index,
            beforeEnter: isUnique
        },
        {
            path: "/customer/blank",
            component: CustomerBlank,
            beforeEnter: isUnique
        },
        {
            path: "/service/:service_id/cost",
            component: ServiceCost,
            beforeEnter: isUnique,
            props: true
        },
        {
            path: "/service/:service_id",
            component: ServiceDetails,
            beforeEnter: isUnique,
            props: true
        },
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
        {
            path: '/recover/session/identity=:ide&cod=:cod',
            component: RecoverSession,
            beforeEnter: isGuest,
            props:true
        },
        
        //Rutas del cliente logeado
        {
            path: "/customer/report/service",
            component: ServiceReport,
            beforeEnter: isCustomer
        },
        {
            path: "/request/form/service",
            component: ServiceForm,
            beforeEnter: isCustomer
        },
        {
            path: "/customer/rate/service",
            component: RateService,
            beforeEnter: isCustomer
        },
        {
            path: "/customer/payment/link=:id_link/response=:id_response",
            component: Payment,
            props: true
        },

        //Rutas de los proveedores
        {
            path: "/supplier",
            component: Home,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/service/create",
            component: CreateService,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/create/price",
            component: CreatePrice,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/services",
            component: ServiceList,    
            beforeEnter: isSupplier        
        },
        {
            path: "/supplier/:id/service/update",
            component: UpdateService,
            props: true,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/:id/price/update",
            component: UpdatePrice,
            props: true,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/blank",
            component: SuppliersBlank,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/notifications",
            component: Notifications,
            beforeEnter: isSupplier
        },
        {
            path: "/supplier/notifications/details/:notification_id",
            component: NotificationDetails,
            beforeEnter: isSupplier,
            props: true
        },
        {
            path: '/supplier/satisfaction/report',
            component: SatisfactionReport,
            beforeEnter: isSupplier,  
        },

        //Ruta solo para trabajador
        {
            path: "/worker/profile/edit",
            component: EditProfile,
            beforeEnter: isWorker
        },

        //Ruta no registrada
        {
            path: "*",
            component: NotFound
        },
        
    ]
});
