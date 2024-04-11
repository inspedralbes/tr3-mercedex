<template>

  <div
    :class="{ 'fixed inset-y-0 -right-96 flex items-center  transition-all ease-in-out duration-1000 justify-center z-50 bg-black bg-opacity-50': true, 'openModal': mostrarCartModal }">
    <div class="h-full bg-white p-4 shadow-md w-96">
      <button
        class="hover:bg-red-500 hover:text-white hover:rotate-90 rounded-full p-1 absolute top-3 right-3 transition duration-500 ease-in-out"
        @click="cerrarModal">
        <CrossIcon />
      </button>
      <div class="flex flex-col items-center justify-center">
        <h2 class="text-lg font-semibold">Mercedes-Benz Shop</h2>
        <img src="../public/img/mercedes-logo.png" class=" mt-2 w-[50px]" alt="">
      </div>
      <div v-if="cart.length > 0" class="overflow-y-scroll h-[77%]">
        <ul class="flex flex-col gap-4 border-b pb-8 mb-3 mt-10">
          <li v-for="(item, index) in cart" :key="index">
            <div class="flex justify-between">
              <img :src="item.image" class="size-32 object-contain bg-slate-200" alt="Imagen del producto">
              <div class="flex flex-col w-full gap-y-6 justify-between px-2">
                <h3 class="text-sm font-semibold">{{ item.name }}</h3>
                <div class="w-full flex justify-center items-center">
                  <button
                    class="px-3 bg-black border border-black text-white hover:bg-white hover:text-black hover:border-black"
                    @click="changeQuantity(item, '-')">-</button>
                  <p class="w-1/4 text-center border border-black">{{ item.quantity }}</p>
                  <button
                    class="px-3 bg-black border border-black text-white hover:bg-white hover:text-black hover:border-black"
                    @click="changeQuantity(item, '+')">+</button>
                </div>
                <div class="flex justify-between items-center">
                  <button class="text-xs text-red-500 font-semibold"
                    @click="mostrarConfirmacion(item.id)">Quitar</button>
                  <p class="text-sm font-bold"> {{ item.price }}€</p>
                </div>
              </div>

            </div>
          </li>
        </ul>
      </div>

      <div v-else class="flex items-center justify-center h-[88%]">
        <p>Tu carrito está vacío.</p>
      </div>

      <div v-if="cart.length > 0" class="flex justify-between items-center py-2 mt-5">
        <div class="flex flex-col">
          <p class="text-sm">Total</p>
          <p class="text-lg font-semibold">{{ calcularTotal() }}€</p>
        </div>
        <NuxtLink :to="getLoggedIn() ? '/compra' : '/login'"
          class="bg-black py-2 px-6 rounded-md text-sm font-semibold border-2 border-black text-cWhite hover:text-black hover:bg-white transition duration-200 ease-in-out">
          Comprar</NuxtLink>
      </div>

    </div>
  </div>
  <ConfirmationModal class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalConfirmacion"
    @eliminar="eliminarDelCarrito" @cancelar="cerrarModal" />
</template>

<script>

import { useStores } from '~/stores/counter';
import ConfirmationModal from './ConfirmationModal.vue';
import { computed } from 'vue';
import axios from 'axios';

export default {
  components: {
    ConfirmationModal
  },
  data() {
    const cart = useStores();

    return {
      mostrarCartModal: computed(() => cart.mostrarCartModal),
      mostrarModalConfirmacion: computed(() => cart.mostrarConfirmationModal),
      itemAEliminar: null,
      cartLength: computed(() => cart.cart.length)
    }
  },
  computed: {
    cart() {
      return useStores().cart;
    }
  },
  methods: {
    cerrarModalYIrATienda() {
      this.cerrarModal();
      this.$router.push('/tienda');
    },
    mostrarConfirmacion(itemId) {
      this.itemAEliminar = itemId;
      useStores().mostrarConfirmationModal = true;
    },
    eliminarDelCarrito() {
      useStores().removeFromCart(this.itemAEliminar);
      useStores().mostrarConfirmationModal = false;
    },
    calcularTotal() {
      let total = this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      return total.toFixed(2);
    },
    getLoggedIn() {
      const store = useStores();
      return store.getLoggedIn();
    },
    cerrarModal() {
      const cart = useStores();
      cart.setCartModal(false);
    },
    changeQuantity(item, ope) {
      const cart = useStores();

      if (ope === '+') {
        cart.addToCart(item);
      } else {
        cart.decreaseQuantity(item.id);
      }
    },
    goBuy() {
      this.cerrarModal();
      setTimeout(() => {
        this.$router.push(this.getLoggedIn() ? '/compra' : '/login');
      }, 1000);
    }
  }
}
</script>



<style>
.openModal {
  box-shadow: black 8px 2px 20px 2px;
  right: 0;
}
</style>
