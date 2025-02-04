<template>
  <div class="home-container">
    <header>
      <h1>Ruru Concept Store</h1>
      <p class="tagline">The place where you find classy, stylish, and comfortable products for the modern city girl.</p>
      <nav>
        <router-link to="/cart" class="cart-link">
          🛍 Cart ({{ cartStore.totalItems }})
        </router-link>
      </nav>
    </header>

    <section class="catalog">
      <h2>Product Catalog</h2>
      <div class="product-list">
        <div v-for="product in products" :key="product.id" class="product-card">
          <h3>{{ product.name }}</h3>
          <p>{{ product.description }}</p>
          <p class="price">{{ product.price }} KZT</p>
          <router-link :to="`/product/${product.id}`" class="details-link">View Details</router-link>
          <button @click="cartStore.addToCart(product)">Add to Cart</button>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useCartStore } from '@/cartStore.js';

const cartStore = useCartStore();
const products = ref([]);

onMounted(async () => {
  const response = await fetch('/api/products');
  products.value = await response.json();
});
</script>

<style scoped>
.home-container {
  text-align: center;
  padding: 20px;
  background-color: #ffe4e1;
}
.tagline {
  font-size: 1.2em;
  font-style: italic;
  color: #d63384;
}
.catalog {
  margin-top: 20px;
}
.product-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  padding: 20px;
}
.product-card {
  background: white;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.price {
  font-weight: bold;
  color: #d63384;
}
.details-link {
  display: block;
  margin-top: 10px;
  color: #007bff;
  text-decoration: none;
}
.cart-link {
  font-size: 1.2em;
  font-weight: bold;
  color: #d63384;
  text-decoration: none;
}
</style>
