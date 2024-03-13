<template>
    <div class="bg-black">
      <Header/>
    </div>
    <div class="grid grid-cols-3 gap-4">
      <div class="bg-gray-200 m-16 p-14 rounded-lg shadow-md" 
        v-for="(producto, index) in productos" 
        :key="index"
      >
        <img :src="producto.image" alt="">
        <h2 class="text-xl font-bold mb-2">{{ producto.name }}</h2>
        <p class="mb-2">{{ producto.description }}</p>
        <p>{{ producto.price }}€</p>
        <button class="bg-black text-white py-1 px-2 rounded" @click="añadirCarrito(producto)">Añadir al carro</button>
      </div>
    </div>
  </template>
  
  <script>
  import { useCartStore } from '~/stores/counter'; // Importa la tienda del carrito
  import axios from 'axios';
  
  export default {
    data() {
      return {
        productos: []
      }
    },
    methods: {
      async añadirCarrito(producto) {
        useCartStore().addToCart(producto);
        console.log("Producto añadido al carrito:", producto);
      }
    },
    async mounted() {
      try {
        const response = await axios.get('http://localhost:8000/api/products');
        this.productos = response.data.products;
        console.log("Esta es la respuesta", this.productos);
      } catch (error) {
        console.error('Error:', error);
      }
    }
  }
  </script>
  