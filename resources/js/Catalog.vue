
<template>
  <div>
    <h2>Product Catalog</h2>
    <ul>
      <li v-for="product in products" :key="product.id">
        <strong>{{ product.name }}</strong>
        <p>{{ product.description }}</p>
        <p>Price: {{ product.price }}</p>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

// Define a reactive array for products
const products = ref([]);

// Fetch products from the API when the component is mounted
onMounted(async () => {
  const response = await fetch('/api/products');  // Make API call
  const data = await response.json();  // Parse the response
  products.value = data;  // Set the fetched products to the reactive variable
});
</script>

