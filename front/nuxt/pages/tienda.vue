<template>
  <div class="bg-black">
    <Header />
  </div>
  <div class="grid grid-cols-3 gap-4">
    <div class="bg-gray-200 m-16 p-14 rounded-lg shadow-md" v-for="(producto, index) in productos" :key="index">
      <img :src="producto.image" alt="">
      <h2 class="text-xl font-bold mb-2">{{ producto.name }}</h2>
      <p class="mb-2">{{ producto.description }}</p>
      <p>{{ producto.price }}€</p>
      <button class="bg-black text-white py-1 px-2 rounded" @click="añadirCarrito(producto)">Añadir al carro</button>
    </div>
  </div>
  <Loader class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalLoader"></Loader>
</template>

<script>
import { useStores } from '~/stores/counter';
import Loader from '~/components/Loader.vue';
import axios from 'axios';

export default {
  data() {
    return {
      productos: [],
      mostrarModalLoader: false
    }
  },
  methods: {
    async añadirCarrito(producto) {
      useStores().addToCart(producto);
      console.log("Producto añadido al carrito:", producto);
    }
  },
  async mounted() {
    this.mostrarModalLoader = true;
    try {
      const response = await axios.get('http://mercedex.daw.inspedralbes.cat/back/laravel/public/api/products');
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