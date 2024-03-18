<template>

  <div
    :class="{ 'fixed inset-y-0 -right-96 flex items-center  transition-all ease-in-out duration-1000 justify-center z-50 bg-black bg-opacity-50': true, 'openModal': mostrarCartModal }">
    <div class="h-full bg-white p-4 shadow-md w-96">
      <button class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded"
        @click="cerrarModal">Cerrar</button>
      <h2 class="text-lg font-semibold mb-4">Tu carrito</h2>
      <div v-if="cart.length > 0" class="overflow-y-auto">
        <ul>
          <li v-for="(item, index) in cart" :key="index">
            <div class="flex justify-between">
              <div>
                <h3 class="text-sm font-semibold">{{ item.name }}</h3>
                <p class="text-xs">{{ item.quantity }}</p>
              </div>
              <div>
                <p class="text-sm">{{ item.price }}€</p>
                <button class="text-xs text-red-500" @click="mostrarConfirmacion(item.id)">Quitar</button>
              </div>

            </div>
          </li>
        </ul>
        <p class="mt-4">Total: {{ calcularTotal() }}€</p>
      </div>
      <div v-else class="flex items-center justify-center">
        <p>Tu carrito está vacío.</p>
      </div>
      <button v-if="cart.length === 0" class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded"
        @click="cerrarModalYIrATienda">Ir a la tienda</button>
      <NuxtLink to="/compra">
        <button>Comprar</button>
      </NuxtLink>
    </div>
  </div>
  <ConfirmationModal class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalConfirmacion"
    @eliminar="eliminarDelCarrito" @cancelar="cerrarModal" />
</template>

<script>

import { useCartStore } from '~/stores/counter';
import ConfirmationModal from './ConfirmationModal.vue';
import { computed } from 'vue';
import axios from 'axios';

export default {
  components: {
    ConfirmationModal
  },
  data() {
    const cart = useCartStore();
    return {
      mostrarCartModal: computed(() => cart.mostrarCartModal),
      mostrarModalConfirmacion: false,
      itemAEliminar: null
    }
  },
  computed: {
    cart() {
      return useCartStore().cart;
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
      useCartStore().removeFromCart(this.itemAEliminar);
      this.mostrarModalConfirmacion = false;
    },
    calcularTotal() {
      return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    },
    cerrarModal() {
      const cart = useCartStore();
      cart.setCartModal(false);
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
