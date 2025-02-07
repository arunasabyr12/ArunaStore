<template>
  <div>
    <h2>Админка - Управление товарами</h2>

    <!-- Форма добавления товара -->
    <h3>Добавить товар</h3>
    <form @submit.prevent="addProduct">
      <input v-model="newProduct.name" placeholder="Название" required>
      <input v-model="newProduct.description" placeholder="Описание" required>
      <input v-model="newProduct.size" placeholder="Размер" required>
      <input v-model="newProduct.price" type="number" placeholder="Цена" required>
      <button type="submit">Добавить</button>
    </form>

    <hr>

    <!-- Список товаров -->
    <h3>Список товаров</h3>
    <ul>
      <li v-for="product in products" :key="product.id">
        <strong>{{ product.name }}</strong> - {{ product.price }} KZT
        <button @click="editProduct(product)">edit</button>
        <button @click="deleteProduct(product.id)">❌</button>
      </li>
    </ul>

    <!-- Форма редактирования -->
    <div v-if="editingProduct">
      <h3>Редактировать товар</h3>
      <form @submit.prevent="updateProduct">
        <input v-model="editingProduct.name" required>
        <input v-model="editingProduct.description" required>
        <input v-model="editingProduct.size" required>
        <input v-model="editingProduct.price" type="number" required>
        <button type="submit">Сохранить</button>
      </form>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const products = ref([]);
const newProduct = ref({ name: '', description: '', size: '', price: '' });
const editingProduct = ref(null);

// Загружаем товары при загрузке страницы
onMounted(async () => {
  const response = await fetch('/api/products');
  products.value = await response.json();
});

// Добавление товара
const addProduct = async () => {
  const response = await fetch('/api/products', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(newProduct.value)
  });

  if (response.ok) {
    const product = await response.json();
    products.value.push(product);
    newProduct.value = { name: '', description: '', size: '', price: '' };
  }
};

// Удаление товара
const deleteProduct = async (id) => {
  if (!confirm("Удалить товар?")) return;

  const response = await fetch(`/api/products/${id}`, { method: 'DELETE' });

  if (response.ok) {
    products.value = products.value.filter(product => product.id !== id);
  }
};

// Начать редактирование товара
const editProduct = (product) => {
  editingProduct.value = { ...product };
};

// Обновление товара
const updateProduct = async () => {
  const response = await fetch(`/api/products/${editingProduct.value.id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(editingProduct.value)
  });

  if (response.ok) {
    const updatedProduct = await response.json();
    const index = products.value.findIndex(p => p.id === updatedProduct.id);
    products.value[index] = updatedProduct;
    editingProduct.value = null;
  }
};
</script>
