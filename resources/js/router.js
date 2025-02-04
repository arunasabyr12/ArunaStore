import {
    createRouter,
    createWebHashHistory
} from 'vue-router';
import Home from './Home.vue';
import Catalog from './Catalog.vue';
import ProductPage from './ProductPage.vue';
import Cart from './Cart.vue';

const routes = [{
        path: '/',
        component: Home
    },
    {
        path: '/catalog',
        component: Catalog
    },
    {
        path: '/product/:id',
        component: ProductPage
    },
    {
        path:'/cart',
        component: Cart
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
