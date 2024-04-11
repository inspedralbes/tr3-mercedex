<template>
    <div class="bg-black">
        <Header />
    </div>
    <div class="mt-20">
        <h1 class="text-center font-bold text-5xl">Mis Pedidos</h1>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-gray-200 m-16 p-14 rounded-lg shadow-md" v-for="(ticket, index) in tickets" :key="index"
            :class="{ 'opacity-50': ticket.status === 'cancelado' }">
            <h2 class="text-3xl font-bold mb-1">Ticket {{ ticket.id }}</h2>
            <div class="border-b-2 border-black mb-9"></div>
            <p class="mb-2">Dirección: {{ ticket.address }}</p>
            <p class="mb-2">Teléfono: {{ ticket.phone }}</p>
            <p class="mb-2">Estado: {{ ticket.status }}</p>
            <p class="mb-9">Para: {{ ticket.name }}</p>
            <div v-for="(product, pIndex) in ticket.products" :key="`product-${pIndex}`">
                <div class="flex items-center mb-14">
                    <img :src="product.image" alt="" class="w-30 h-10 mr-2">
                    <div>
                        <p class="font-bold">{{ product.name }}</p>
                        <p class="text-sm">Cantidad: {{ product.quantity }}</p>
                        <p class="text-sm">Precio: {{ product.price }}€</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center mt-5">
                <p class="text-2xl font-bold">Total: {{ ticket.total }}€</p>
            </div>
            <div class="flex justify-center items-center mt-5">
                <button v-if="ticket.status !== 'cancelado'" class="bg-black text-white py-2 px-20 rounded"
                    @click="cancelar(ticket.id)">Cancelar</button>
            </div>
        </div>
    </div>
    <Loader class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalLoader"></Loader>
</template>



<script>
import { useStores } from '~/stores/counter';
import axios from 'axios';
import Loader from '~/components/Loader.vue';
const url = "https://mercedex.daw.inspedralbes.cat/back/laravel/public/api";


export default {
    data() {
        return {
            tickets: [],
            mostrarModalLoader: false
        }
    },
    methods: {
        async cancelar(id) {
            this.mostrarModalLoader = true;
            const token = useStores().userInfo.token;
            if (!token) {
                console.error("No se encontró el token de autenticación.");
                this.mostrarModalLoader = false;
                return;
            }

            try {
                const response = await axios.post(`${url}/cancelar/${id}`, null, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                window.location.reload();
                console.log("Respuesta:", response.data);
                this.mostrarModalLoader = false;

            } catch (error) {
                console.log('Error:', error);
                this.mostrarModalLoader = false;
            }
        },

    },
    async mounted() {
        const token = useStores().userInfo.token;
        this.mostrarModalLoader = true;
        if (!token) {
            console.error("No se encontró el token de autenticación.");
            this.mostrarModalLoader = false;
            return;
        }

        try {
            const response = await axios.get(`${url}/tickets`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
            this.tickets = response.data;
            console.log("Esta es la respuesta", this.tickets);
            this.mostrarModalLoader = false;
        } catch (error) {
            console.error('Error:', error);
            this.mostrarModalLoader = false;
        }
    }

}
</script>