<template>

  <div
    :class="{ 'fixed inset-y-0 -right-96 flex items-center  transition-all ease-in-out duration-1000 justify-center z-50 bg-black bg-opacity-50': true, 'openModal': mostrarCartModal }">
    <div class="h-full bg-white p-4 shadow-md w-96">
      <button class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded"
        @click="cerrarModal">Cerrar</button>
      <h2 class="text-lg font-semibold mb-4">Tu carrito</h2>
      <div v-if="cart.length > 0" class="overflow-y-auto">
        <ul class="flex flex-col gap-4 border-b pb-8 mb-8">
          <li v-for="(item, index) in cart" :key="index">
            <div class="flex justify-between">
              <img :src="item.image" class="size-32 object-contain bg-slate-200" alt="Imagen del producto">

              <div class="flex flex-col w-full gap-y-6 justify-between px-2">
                <h3 class="text-sm font-semibold">{{ item.name }}</h3>
                <div class="w-full flex justify-center items-center">
                  <button class="px-3 bg-blue-200 border border-blue-200 hover:bg-blue-300"
                    @click="changeQuantity(item, '-')">-</button>
                  <p class="w-full text-center  border border-black">{{ item.quantity }}</p>
                  <button class="px-3 bg-blue-200 hover:bg-blue-300" @click="changeQuantity(item, '+')">+</button>
                </div>
                <div class="flex justify-between items-center">
                  <button class="text-xs text-red-500 font-semibold"
                    @click="mostrarConfirmacion(item.id)">Quitar</button>
                  <p class="text-sm font-semibold">{{ item.price }}€</p>
                </div>
              </div>

            </div>
          </li>
        </ul>
      </div>

      <div v-else class="flex items-center justify-center my-6">
        <p>Tu carrito está vacío.</p>
      </div>

      <div class="flex justify-between items-center">
        <div class="flex flex-col">
          <p class="text-sm">Total</p>
          <p class="text-lg font-semibold">{{ calcularTotal() }}€</p>
        </div>
      <NuxtLink to="/compra" class="bg-primary py-2 px-6 rounded-md text-sm font-semibold text-cWhite hover:bg-primary_dark transition duration-200 ease-in-out">Comprar</NuxtLink>
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
      mostrarModalConfirmacion: false,
      itemAEliminar: null
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
      this.mostrarModalConfirmacion = true;
    },
    eliminarDelCarrito() {
      useStores().removeFromCart(this.itemAEliminar);
      this.mostrarModalConfirmacion = false;
    },
    calcularTotal() {
      return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    },
    cerrarModal() {
      const cart = useStores();
      cart.setCartModal(false);
    },
    changeQuantity(item, ope) {
      const cart = useStores();

      if (ope === '+') {
        cart.addToCart(item);
        console.log('Sumar');
      } else {
        cart.decreaseQuantity(item.id);
        console.log('Restar');
      }
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
