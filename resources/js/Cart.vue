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


      <p><strong>Общая сумма: {{ totalPrice }} KZT</strong></p>


      <router-link to="/order">
        <button class="btn btn-primary">Оформить заказ</button>
      </router-link>
    </div>
    <p v-else>Корзина пуста.</p>

    <router-link to="/">⬅ Назад в магазин</router-link>
  </div>
</template>

<script setup>
import { useCartStore } from '@/cartStore.js';
import { computed } from 'vue';

const cartStore = useCartStore();

const totalPrice = computed(() => cartStore.totalPrice);
</script>
