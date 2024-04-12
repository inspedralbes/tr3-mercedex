<template>
    <div class="bg-black w-full h-screen text-white">
        <LoginHeader class="pt-4" />
        <section class="flex justify-center items-center gap-y-8 h-[80vh]">
            <div class="h-[60%] flex justify-center items-center rounded-lg overflow-hidden">
                <div class="bg-[#1E1E1E] flex flex-col justify-center items-center py-8 px-6 relative w-[45%] h-full">
                    <h2 class="text-3xl">Mercedes-Benz me ID</h2>
                    <span class="w-14 h-0.5 bg-white mt-2"></span>

                    <div class="mt-10 w-full">
                        <div v-if="error" class="bg-red-500 text-white p-2 rounded">
                            <p>{{ this.message }}</p>
                        </div>
                        <form class="flex flex-col gap-y-4 items-start" @submit.prevent="login">
                            <input
                                class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                type="email" placeholder="Correo electronico" v-model="email">
                            <input
                                class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                type="password" placeholder="Contraseña" v-model="password">
                            <button
                                class="py-1 px-4 relative bg-transparent mt-2 overflow-hidden transition 
                            duration-500 ease-in-out font-semibold hover:text-black hover:bg-white border-white border-2">Enviar
                            </button>
                        </form>
                    </div>

                    <div class="flex gap-x-4 mt-10">
                        <p class="font-semibold">¿Aun no tienes Mercedes me ID?</p>
                        <NuxtLink to="/register" class="text-blue-400 relative" id="link">Registrarse
                            <span class="bg-blue-400" id="underlineHover"></span>
                        </NuxtLink>
                    </div>

                    <span class="w-full h-2 absolute bottom-0 left-0 bg-white"></span>
                </div>
                <div class="h-full w-80 w-[55%]">
                    <img class="h-full object-cover w-full"
                        src="/img/img_login.jpg" alt="">
                </div>
            </div>
        </section>
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
      email: '',
      password: '',
      mostrarModalLoader: false,
      error: false,
      message: ''
    }
  },

  methods: {
    async login() {
      const store = useStores(); 
      this.mostrarModalLoader = true;
      try {

        const response = await axios.post(`${url}/login`, {
          email: this.email,
          password: this.password
        });
        
        store.setUserInfo({
          id: response.data.data.user.id,
          name: response.data.data.user.name,
          surnames: response.data.data.user.surnames,
          email: response.data.data.user.email,
          token: response.data.data.token,
        });
        store.setLoggedIn(true);
        this.$router.push('/tienda');
        this.mostrarModalLoader = false;
      } catch (error) {

        console.error('Error:', error);
        this.error = true;
        this.message = error.response.data.message;

        this.mostrarModalLoader = false;
      }
    }
  }
}
</script>

<style>
    #underlineHover{
        position: absolute;
        width: 0%;
        height: 2px;
        bottom: 0;
        left: 0;
        transition: width 0.3s ease-in-out; 
    }
    #link:hover #underlineHover{
        width: 100%;
    }
</style>