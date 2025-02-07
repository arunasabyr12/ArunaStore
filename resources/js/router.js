import {
    createRouter,
    createWebHashHistory
} from 'vue-router';
import Home from './Home.vue';
import Catalog from './Catalog.vue';
import ProductPage from './ProductPage.vue';
import Cart from './Cart.vue';
import Order from './Order.vue';
import ThankYou from './ThnakYou.vue';
import Admin from './Admin.vue';

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
    },
    {
        path:'/order',
        component: Order
    },
    {
        path:'/thank-you',
        component: ThankYou
    },
    {
        path:'/admin',
        component: Admin
    }
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

export default router;
