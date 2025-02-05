<template>
  <div>
    <h2>Placing an order</h2>

    <div v-if="cartStore.cart.length">
      <ul>
        <li v-for="item in cartStore.cart" :key="item.id">
          <strong>{{ item.name }}</strong> — 
          {{ item.price }} KZT × {{ item.quantity }} pc.
        </li>
      </ul>

      <p><strong>Total: {{ totalPrice }} KZT</strong></p>

      <h3>Please give us your contact information to place an order</h3>
      <form @submit.prevent="placeOrder">
        <div>
          <label for="name">Name:</label>
          <input type="text" id="name" v-model="orderForm.name" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="orderForm.email" required />
        </div>
        <div>
          <label for="address">Address:</label>
          <input type="text" id="address" v-model="orderForm.address" required />
        </div>
        <div>
          <label for="phone">Phone number:</label>
          <input type="text" id="phone" v-model="orderForm.phone" required />
        </div>

        <button type="submit" class="btn btn-success" :disabled="loading">
          {{ loading ? "Processing..." : "Submit an order" }}
        </button>
      </form>

      <p v-if="successMessage" class="success">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
    </div>
    <p v-else>Your cart is empty</p>

    <router-link to="/cart">⬅ Review the order list</router-link>
  </div>
</template>

<script setup>
import { useCartStore } from '@/cartStore.js';
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const cartStore = useCartStore();
const router = useRouter();

const orderForm = ref({
  name: '',
  email: '',
  address: '',
  phone: '',
});

const totalPrice = computed(() => cartStore.totalPrice);

const loading = ref(false);
const successMessage = ref('');
const errorMessage = ref('');

const placeOrder = async () => {
  loading.value = true;
  successMessage.value = '';
  errorMessage.value = '';

  try {
    await axios.post('http://127.0.0.1:8000/api/orders', {
      name: orderForm.value.name,
      email: orderForm.value.email,
      address: orderForm.value.address,
      phone: orderForm.value.phone,
      items: cartStore.cart,
      total_price: totalPrice.value,
    });

    successMessage.value = "Your order has been placed successfully!";
    cartStore.clearCart();

    // ✅ Перенаправляем на страницу "Спасибо за заказ"
    setTimeout(() => router.push('/thank-you'), 1000);
  } catch (error) {
    errorMessage.value = error.response?.data?.message || "Failed to place order. Please try again.";
  } finally {
    loading.value = false;
  }
};
</script>

<style>
.success { 
  color: green; 
  font-weight: bold; 
  margin-top: 10px;
}

.error { 
  color: red; 
  font-weight: bold; 
  margin-top: 10px;
}
</style>
