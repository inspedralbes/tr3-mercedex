<template>
    <div class="bg-black w-full h-screen text-white">
        <LoginHeader class="pt-4" />
        <section class="flex justify-center items-center gap-y-8 h-[80vh]">
            <div class="h-[70%] flex justify-center items-center rounded-lg overflow-hidden">
                <div class="bg-[#1E1E1E] flex flex-col justify-center items-center py-8 px-6 relative w-[45%] h-full">
                    <h2 class="text-3xl">Mercedes-Benz me ID</h2>
                    <span class="w-14 h-0.5 bg-white mt-2"></span>

                    <div class="mt-10 w-full">
                        <form class="flex flex-col gap-y-4 items-start" @submit.prevent="register">
                            <div class="flex justify-between items-center w-full gap-8">

                                <input
                                    class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                    type="text" placeholder="Nombre" v-model="name">
                                <input
                                    class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                    type="text" placeholder="Apellidos" v-model="surnames">
                            </div>
                            <input
                                class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                type="email" placeholder="Correo electronico" v-model="email">
                            <input
                                class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                type="password" placeholder="Contraseña" v-model="password">
                            <input
                                class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                                type="password" placeholder="Repetir Contraseña" v-model="password_confirmation">
                            <button
                                class="py-1 px-4 relative bg-transparent mt-2 overflow-hidden transition 
                            duration-500 ease-in-out font-semibold hover:text-black hover:bg-white border-white border-2"
                                >Enviar
                            </button>
                        </form>
                    </div>

                    <div class="flex gap-x-4 mt-10">
                        <p class="font-semibold">¿Ya tienes Mercedes me ID?</p>
                        <NuxtLink to="/login" class="text-blue-400 font-semibold relative" id="link">Login
                            <span class="bg-blue-400" id="underlineHover"></span>
                        </NuxtLink>
                    </div>

                    <span class="w-full h-2 absolute bottom-0 left-0 bg-white"></span>
                </div>
                <div class="h-full w-80 w-[55%]">
                    <img class="h-full object-cover w-full"
                        src="https://soymotor.com/sites/default/files/2023-04/mercedes-benz-clase-e-2024-exterior-1-soymotor.jpg"
                        alt="">
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            surnames: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },

    methods: {
        comprobar() {
            console.log(this.email)
            console.log(this.password);
        },

        async register() {
            const response = await axios.post('http://localhost:8000/api/register', {
                email: this.email,
                name: this.name,
                surnames: this.surnames,
                password: this.password,
                password_confirmation: this.password_confirmation

            });
            console.log(response.data);
        }
    }
}
</script>
