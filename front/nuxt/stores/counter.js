import { defineStore } from "pinia";

export const useCartStore = defineStore("cart", {
    state: () => ({
        cart: [],
    }),
    actions: {
        addToCart(item) {
            const existingItem = this.cart.find((i) => i.id === item.id);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.cart.push({ ...item, quantity: 1 });
            }
        },
        removeFromCart(itemId) {
            const index = this.cart.findIndex((item) => item.id === itemId);

            if (index !== -1) {
                this.cart.splice(index, 1);
            }
        },
        clearCart() {
            this.cart = [];
        },

        
    },
});
