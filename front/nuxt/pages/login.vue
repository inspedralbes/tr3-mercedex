<template>
    <div class="bg-black w-full h-screen text-white">
        <LoginHeader class="pt-4" />
        <section class="flex justify-center items-center gap-y-8 h-[90vh]">
            <div
                class="bg-[#1E1E1E] flex flex-col justify-center items-center py-8 px-6 relative w-[30%] h-[60%] rounded-lg overflow-hidden">
                <h2 class="text-3xl">Mercedes-Benz me ID</h2>
                <span class="w-14 h-0.5 bg-white mt-2"></span>

                <div class="mt-10 w-full">
                    <form class="flex flex-col gap-y-4 items-start" action="#">
                        <input
                            class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                            type="email" placeholder="Correo electronico" v-model="email">
                        <input
                            class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0"
                            type="password" placeholder="Contraseña" v-model="password">
                        <button
                            class="py-1 px-4 relative bg-transparent mt-2 overflow-hidden transition 
                            duration-500 ease-in-out font-semibold hover:text-black hover:bg-white border-white border-2" @click="comprobar()">Enviar
                        </button>
                    </form>
                </div>

                <div class="flex gap-x-4 mt-10">
                    <p class="font-semibold">¿Aun no tienes Mercedes me ID?</p>
                    <NuxtLink to="/register" class="text-blue-400">Registrarse</NuxtLink>
                </div>

                <span class="w-full h-2 absolute bottom-0 left-0 bg-white"></span>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },

    methods: {
        comprobar() {
            console.log(this.email)
            console.log(this.password);
        }
    }
}
</script>