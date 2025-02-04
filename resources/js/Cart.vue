<template>
  <div>
    <h2>Корзина</h2>
    <div v-if="cartStore.cart.length">
      <ul>
        <li v-for="item in cartStore.cart" :key="item.id">
          <strong>{{ item.name }}</strong> — 
          {{ item.price }} KZT × {{ item.quantity }} шт.

          <button @click="cartStore.removeFromCart(item.id)">➖</button>
        </li>
      </ul>
    </div>
    <p v-else>Корзина пуста.</p>

    <router-link to="/">⬅ Назад в магазин</router-link>
  </div>
</template>

<script setup>
import { useCartStore } from '@/cartStore.js';

const cartStore = useCartStore();
</script>
