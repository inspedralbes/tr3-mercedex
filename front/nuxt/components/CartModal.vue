<template>
<div class=" fixed inset-y-0 right-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div  class="h-full bg-white p-4 shadow-md w-80"> 
      <button class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded" @click="cerrarModal">Cerrar</button>
      <h2 class=" text-lg font-semibold mb-4">Tu carrito</h2>
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
                <button class="text-xs text-red-500" @click="eliminarDelCarrito(item.id)">Eliminar</button>
              </div>
            </div>
          </li>
        </ul>
        <p class="mt-4">Total: {{ calcularTotal() }}€</p>
      </div>
      <div v-else class="flex items-center justify-center">
        <p>Tu carrito está vacío.</p>
      </div>
      <button v-if="cart.length === 0" class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded" @click="cerrarModalYIrATienda">Ir a la tienda</button>

    </div>
  </div>
</template>

<script>
import { useCartStore } from '~/stores/counter'; 

export default {
  props: {
    cerrarModal: {
      type: Function,
      required: true
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
    eliminarDelCarrito(itemId) {
      useCartStore().removeFromCart(itemId);
    },
    calcularTotal() {
      // Calcular el total del carrito sumando el precio de todos los productos y teniendo en cuenta la cantidad
      return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
    }
  }
}
</script>
