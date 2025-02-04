<template>
  <div class="catalog">
    <h2>Ruru Concept Store</h2>

    <!-- Ссылка на корзину с количеством товаров -->
    <div class="cart-link">
      🛒 <router-link to="/cart">Cart ({{ cartCount }})</router-link>
    </div>

    <ul>
      <li v-for="product in products" :key="product.id">
        <strong>{{ product.name }}</strong>

        <router-link :to="'/product/' + product.id">View Details</router-link>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useCartStore } from '@/cartStore.js';

const products = ref([]);
const cartStore = useCartStore(); 

// Количество товаров в корзине
const cartCount = computed(() => cartStore.totalItems);

onMounted(async () => {
  const response = await fetch('/api/products');
  products.value = await response.json();
});
</script>

<style scoped>
.description {
  font-style: italic;
  color: #555;
  margin-bottom: 20px;
}
.cart-link {
  margin-bottom: 20px;
  font-weight: bold;
}
.cart-link a {
  text-decoration: none;
  color: #d9534f;
}
</style>
