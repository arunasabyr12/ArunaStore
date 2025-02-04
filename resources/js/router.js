import {
    createRouter,
    createWebHistory
} from 'vue-router';
import Home from './Home.vue';
import Catalog from './Catalog.vue';

const routes = [{
        path: '/',
        component: Home
    },
    {
        path: '/catalog',
        component: Catalog
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
