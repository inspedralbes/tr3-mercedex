import { defineStore } from "pinia";

export const useStores = defineStore("counter",{
    state: () => ({
        cart: [],
        mostrarCartModal: false,
        flag: "/img/flags/spain.jpg",
        loggedIn: false,
        userInfo: {
            id: null,
            name: "",
            surnames: "",
            email: "",
            token: "",
        },
    }),
    persist: {
        storage: persistedState.localStorage,
        paths:['userInfo', 'loggedIn','cart']
    },
    actions: {
        addToCart(item) {
            const existingItem = this.cart.find((i) => i.id === item.id);

            if (existingItem) {
                existingItem.quantity++;
            } else {
                this.cart.push({ ...item, quantity: 1 });
            }

        },
        lengthCart() {
            return this.cart.length;
        },
        removeFromCart(itemId) {
            const index = this.cart.findIndex((item) => item.id === itemId);

            if (index !== -1) {
                this.cart.splice(index, 1);
            }
        },
        decreaseQuantity(itemId) {
            const item = this.cart.find((item) => item.id === itemId);

            if (item) {
                item.quantity--;

                if (item.quantity === 0) {
                    this.removeFromCart(itemId);
                }

                this.cartCount--;
            }
        },
        clearCart() {
            this.cart = [];
        },

        /* --------------------------------- GETTERS -------------------------------- */
        getCartModal() {
            return this.mostrarCartModal;
        },

        getFlag() {
            return this.flag;
        },
        getUserInfo() {
            return this.userInfo;
        },
        getLoggedIn() {
            return this.loggedIn;
        },
        getCart() {
            return this.cart;
        },

        /* --------------------------------- SETTERS -------------------------------- */
        setCartModal(value) {
            this.mostrarCartModal = value;
        },
        setFlag(value) {
            this.flag = value;
        },
        setUserInfo(userInfo) {
            this.userInfo.id = userInfo.id;
            this.userInfo.name = userInfo.name;
            this.userInfo.surnames = userInfo.surnames;
            this.userInfo.email = userInfo.email;
            this.userInfo.token = userInfo.token;
        },
        setLoggedIn(value) {
            this.loggedIn = value;
        },
    },
});
