<template>
    <div>
        <h2>{{ product.name }}</h2>
        <p>{{ product.description }}</p>
        <p>Цена: {{ product.price }} KZT</p>
        <button @click="cartStore.addToCart(product)">Добавить в корзину</button>
        <p>
            <router-link to="/cart">Корзина ({{ cartStore.totalItems }})</router-link> <br>
                <router-link to="/">⬅ Назад в магазин</router-link>
        </p>
    </div>
</template>

<script setup>
    import {
        ref,
        onMounted
    } from 'vue';
    import {
        useRoute
    } from 'vue-router';
    import {
        useCartStore
    } from '@/cartStore.js';


    const route = useRoute();
    const product = ref({});
    const cartStore = useCartStore();

    onMounted(async () => {
        const response = await fetch(`/api/products/${route.params.id}`);
        product.value = await response.json();
    });

    const addToCart = () => {
        cartStore.addToCart(product.value);
    };

</script>
