<template>
  <div class="bg-black">
    <Header />
  </div>

  <div class="mt-20">
    <h1 class="text-center font-bold text-5xl">Tienda Oficial de Mercedes-Benz</h1>
  </div>
  <div class="px-4 mt-12">
    <div class="flex justify-center items-center">
      <div class="border-b-2 border-blue-500 mb-5">
        <button v-for="(categoria, index) in categorias" :key="index" @click="mostrarCategoria = categoria"
          :class="{ 'border-b-4 border-blue-500': mostrarCategoria === categoria }"
          class="px-4 py-2 mx-1 my-0 font-bold">{{ categoria }}</button>
      </div>
    </div>
    
    <div v-if="mostrarModalLoader" class="mt-4">
      <Loader class="fixed top-0 left-0 w-full h-full"></Loader>
    </div>
  </div>

  <div class="grid grid-cols-3 gap-4">
    <div class="bg-white m-16 p-14 rounded-lg shadow-md cursor-pointer" v-for="(producto, index) in modelosFiltrados" :key="index"
      :class="{ 'opacity-50': producto.stock === 0 }">
      <div v-if="producto.stock === 0" class="text-red-500 text-center">Este producto está fuera de stock</div>
      <img :src="producto.image" alt="">
      <h2 class="text-xl font-bold mb-2">{{ producto.name }}</h2>
      <p class="mb-2">{{ producto.description }}</p>
      <div class="flex justify-center items-center mt-5">
        <p class="text-3xl font-bold">{{ producto.price }}€</p>
      </div>
      <div class="flex justify-center items-center mt-5">
        <button class="bg-black text-white py-3 px-20 rounded border-2 border-black hover:bg-white hover:text-black transition duration-200 ease-in-out" @click="mostrarDetalles(producto)"
          :disabled="producto.stock === 0">Ver detalles</button>
      </div>
    </div>
  </div>

  <!-- Sección de detalles del producto -->
  <div v-if="productoSeleccionado" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-10 rounded-lg shadow-lg">
      <button class="absolute top-3 right-3 text-gray-600 hover:text-black" @click="cerrarDetalles">&times;</button>
      <img :src="productoSeleccionado.image" alt="">
      <h2 class="text-xl font-bold mb-2">{{ productoSeleccionado.name }}</h2>
      <p class="mb-2">{{ productoSeleccionado.description }}</p>
      <div class="flex justify-center items-center mt-5">
        <p class="text-3xl font-bold">{{ productoSeleccionado.price }}€</p>
      </div>
      <div class="flex justify-center items-center mt-5">
        <button class="bg-black text-white py-3 px-20 rounded border-2 border-black hover:bg-white hover:text-black transition duration-200 ease-in-out" @click="añadirCarrito(productoSeleccionado)"
          :disabled="productoSeleccionado.stock === 0">Añadir al carrito</button>
      </div>
    </div>
  </div>
</template>

<script>
import { useStores } from '~/stores/counter';
import Loader from '~/components/Loader.vue';
import axios from 'axios';

const url = "https://mercedex.daw.inspedralbes.cat/back/laravel/public/api";

export default {
  data() {
    return {
      productos: [],
      mostrarModalLoader: false,
      categorias: ['Automóviles', 'Cargadores', 'Merchandising', 'Accesorios'],
      mostrarCategoria: 'Automóviles',
      productoSeleccionado: null // Agregamos una propiedad para almacenar el producto seleccionado
    }
  },
  methods: {
    async añadirCarrito(producto) {
      useStores().addToCart(producto);
      console.log("Producto añadido al carrito:", producto);
    },
    mostrarDetalles(producto) {
      // Mostrar detalles del producto seleccionado
      this.productoSeleccionado = producto;
    },
    cerrarDetalles() {
      // Cerrar la sección de detalles
      this.productoSeleccionado = null;
    }
  },
  async mounted() {
    this.mostrarModalLoader = true;
    try {
      const response = await axios.get(`${url}/products`);
      this.productos = response.data.products;
      console.log("Version actualizadadaaadadaa")
      console.log("Esta es la respuesta", this.productos);
      this.mostrarModalLoader = false;
    } catch (error) {
      console.error('Error:', error);
      this.mostrarModalLoader = false;
    }
  }
}
</script>
