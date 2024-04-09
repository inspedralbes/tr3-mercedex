<template>
  <div class="bg-black">
    <Header />
  </div>
  <div class="mt-20">
    <h1 class="text-center font-bold text-5xl">Modelos</h1>
  </div>
  <div class="px-4 mt-12">
    <div class="flex justify-center items-center">
      <div class="border-b-2 border-blue-500 mb-5">
        <button v-for="(categoria, index) in categorias" :key="index"
          @click="mostrarCategoria = categoria"
          :class="{ 'border-b-4 border-blue-500': mostrarCategoria === categoria }"
          class="px-4 py-2 mx-1 my-0 font-bold">{{ categoria }}</button>
      </div>
    </div>
    <div class="flex justify-center items-center mt-4">
      <label class="flex justify-center items-center text-black">
        Híbrido
        <input type="checkbox" v-model="filtros.hibrido" class="dark:border-white-400/20 dark:scale-50 transition-all duration-500 ease-in-out dark:hover:scale-60 dark:checked:scale-70 w-10 h-10">
      </label>
      <label class="flex justify-center items-center text-black">
        Eléctrico
        <input type="checkbox" v-model="filtros.electrico" class="dark:border-white-400/20 dark:scale-50 transition-all duration-500 ease-in-out dark:hover:scale-60 dark:checked:scale-70 w-10 h-10">
      </label>
      <label class="flex justify-center items-center text-black">
        Combustión
        <input type="checkbox" v-model="filtros.combustion" class="dark:border-white-400/20 dark:scale-50 transition-all duration-500 ease-in-out dark:hover:scale-60 dark:checked:scale-70 w-10 h-10">
      </label>
    </div>
    <div v-if="mostrarModalLoader" class="mt-4">
      <Loader class="fixed top-0 left-0 w-full h-full"></Loader>
    </div>
    <div v-else class="mt-4">
      <div class="grid grid-cols-4 gap-2">
        <div v-for="(model, index) in modelosFiltrados" :key="index">
          <div class="bg-white m-9 p-6 rounded-lg shadow-lg shadow-xl ">
            <div class="flex justify-center items-center flex-col">
              <h2 class="text-2xl font-bold text-center mb-2 mt-2">{{ model.name }}</h2>
              <img class="mt-10" :src="model.image" alt="">
              <div class="flex justify-center items-center">
                <p class="text-sm text-white rounded-full inline-block px-3 py-1"
                  :class="{ 'bg-blue-500': model.type === 'Eléctrico', 'bg-black': model.type === 'Combustión', 'bg-gradient-to-r from-green-500 to-blue-500': model.type === 'Híbrido' }">
                  {{ model.type }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '~/components/Loader.vue';
import axios from 'axios';

export default {
  components: {
    Loader
  },
  data() {
    return {
      mostrarCategoria: 'Todo',
      modelos: [],
      mostrarModalLoader: false,
      categorias: ['Todo', 'Berlina', 'SUV & Todoterreno', 'Estate', 'Compacto', 'Coupé', 'Cabrio', 'Monovolumen'],
      filtros: {
        hibrido: false,
        electrico: false,
        combustion: false
      }
    };
  },
  computed: {
  modelosFiltrados() {
    if (this.mostrarCategoria === 'Todo') {
      return this.filtrarModelos(this.modelos);
    } else {
      const modelosCategoria = this.modelos.filter(modelo => modelo.bodywork === this.mostrarCategoria);
      return this.filtrarModelos(modelosCategoria);
    }
  }
},
methods: {
  filtrarModelos(modelos) {
    if (this.filtros.hibrido || this.filtros.electrico || this.filtros.combustion) {
      return modelos.filter(modelo => {
        return (this.filtros.hibrido && modelo.type === 'Híbrido') ||
               (this.filtros.electrico && modelo.type === 'Eléctrico') ||
               (this.filtros.combustion && modelo.type === 'Combustión');
      });
    } else {
      return modelos;
    }
  },
  async cargarModelos() {
    this.mostrarModalLoader = true;
    try {
      const response = await axios.get('http://localhost:8000/api/modelos');
      this.modelos = response.data.modelos;
      console.log("Esta es la respuesta", this.modelos);
    } catch (error) {
      console.error('Error:', error);
    } finally {
      this.mostrarModalLoader = false;
    }
  }
},
  mounted() {
    this.cargarModelos();
  }
}
</script>

