import loginpage from "./pages/loginpage.vue";
import register from "./pages/register.vue";
import index from "./pages/index.vue"
import lk from "./pages/lk.vue"
import admin from "./pages/admin.vue";
import settings from "./pages/settings.vue";
export const routes = [

    {
        name: 'login',
        path: '/login',
        component:loginpage,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'register',
        path: '/register',
        component: register,
        meta: {
            requiresAuth: false
        }

    },
    {
        name: 'Index',
        path: '/',
        component: index,
        meta: {
            requiresAuth: false
        }
    },
    {
        name: 'LK',
        path: '/lk',
        component: lk,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Admin',
        path: '/admin',
        component: admin,
        meta: {
            requiresAuth: true
        }
    },
    {
        name: 'Settings',
        path: '/settings',
        component: settings,
        meta: {
            requiresAuth: true
        }
    },



];
