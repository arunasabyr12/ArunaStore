import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    cart: [],
  }),

  getters: {
    totalItems(state) {
      return state.cart.reduce((sum, item) => sum + item.quantity, 0);
    },
    totalPrice(state) {
      return state.cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    },
  },

  actions: {
    addToCart(product) {
      const item = this.cart.find((p) => p.id === product.id);
      if (item) {
        item.quantity++; // ✅ Увеличиваем количество, если товар уже есть
      } else {
        this.cart.push({ ...product, quantity: 1 }); // ✅ Добавляем новый товар
      }
    },

    removeFromCart(productId) {
      const itemIndex = this.cart.findIndex((p) => p.id === productId);
      if (itemIndex !== -1) {
        if (this.cart[itemIndex].quantity > 1) {
          this.cart[itemIndex].quantity--; // ✅ Уменьшаем количество на 1
        } else {
          this.cart.splice(itemIndex, 1); // ✅ Удаляем товар, если количество стало 0
        }
      }
    },

    // New action to clear the cart after order is placed
    clearCart() {
      this.cart = []; // ✅ Очищаем корзину
    },
  },
});
