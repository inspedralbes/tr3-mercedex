<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
      <div class="bg-white p-4 rounded-lg shadow-md">
        <h2 class="text-lg font-semibold mb-4">Tu carrito</h2>
        <div v-if="carrito.length > 0">
        </div>
        <div v-else>
          <p>Tu carrito está vacío.</p>
        </div>
        <button v-if="carrito.length === 0" class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded" @click="cerrarModalYIrATienda">Ir a la tienda</button>
        <button class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded" @click="cerrarModal">Cerrar</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      carrito: {
        type: Array,
        required: true
      },
      cerrarModal: {
        type: Function,
        required: true
      }
    },
    methods: {
      cerrarModalYIrATienda() {
        this.cerrarModal();
        this.$router.push('/tienda');
      }
    }
  }
  </script>