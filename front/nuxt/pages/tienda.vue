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
      <div v-if="producto.stock === 0" class="text-red-500 text-center">Este producto esta fuera de stock</div>
      <img :src="producto.image" alt="">
      <h2 class="text-xl font-bold mb-2">{{ producto.name }}</h2>
      <p class="mb-2">{{ producto.description }}</p>
      <div class="flex justify-center items-center mt-5">
        <p class="text-3xl font-bold">{{ producto.price }}€</p>
      </div>
      <div class="flex justify-center items-center mt-5">
        <button class="bg-black text-white py-3 px-20 rounded border-2 border-black hover:bg-white hover:text-black transition duration-200 ease-in-out" @click="añadirCarrito(producto)"
          :disabled="producto.stock === 0">Añadir al carro</button>
      </div>
    </div>
  </div>
  <Loader class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalLoader"></Loader>

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
    }
  },
  methods: {
    async añadirCarrito(producto) {
      useStores().addToCart(producto);
    }
  },
  computed: {
    modelosFiltrados() {
      return this.productos.filter(producto => producto.category === this.mostrarCategoria);
    }
  },
  async mounted() {
    this.mostrarModalLoader = true;
    try {
      const response = await axios.get(`${url}/products`);
      this.productos = response.data.products;
      this.mostrarModalLoader = false;
    } catch (error) {
      console.error('Error:', error);
      this.mostrarModalLoader = false;
    }
  }
}
</script>
