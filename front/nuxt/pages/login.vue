<template>
    <div class="bg-black w-full h-screen text-white">
        <LoginHeader class="pt-4" />
        <section class="flex justify-center items-center gap-y-8 h-[80vh]">
            <div class="h-[60%] flex justify-center items-center rounded-lg overflow-hidden">
                <div class="bg-[#1E1E1E] flex flex-col justify-center items-center py-8 px-6 relative w-[45%] h-full">
                    <h2 class="text-3xl">Mercedes-Benz me ID</h2>
                    <span class="w-14 h-0.5 bg-white mt-2"></span>

                    <div class="mt-10 w-full">
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
                        src="https://www.hdwallpapers.in/download/mercedes_amg_gt_r_2018_hd_4k-3840x2160.jpg" alt="">
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { useUserStore } from '~/stores/counter';
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },

  methods: {
    comprobar() {
      console.log(this.email)
      console.log(this.password);
    },
    async login() {
      const userStore = useUserStore();

      try {
        console.log("Entra en login?");

        const response = await axios.post('http://localhost:8000/api/login', {
          email: this.email,
          password: this.password
        });
        console.log('Info User: ', response.data);
        
        userStore.setUserInfo({
          name: response.data.name,
          surnames: response.data.surnames,
          email: response.data.email,
          token: response.data.token,
        });

      } catch (error) {
        console.error('Error:', error);
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