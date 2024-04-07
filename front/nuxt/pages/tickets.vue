<template>
    <div class="bg-black">
        <Header />
    </div>
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-gray-200 m-16 p-14 rounded-lg shadow-md" v-for="(ticket, index) in tickets" :key="index">
            <h2 class="text-xl font-bold mb-2">{{ ticket.name }} {{ ticket.lastname }}</h2>
            <p class="mb-2">Dirección:{{ ticket.address }}</p>
            <p class="mb-2">Teléfono:{{ ticket.phone }}</p>
            <p class="mb-2">Estado:{{ ticket.status }}</p>
            <div v-for="(product, pIndex) in ticket.products" :key="`product-${pIndex}`">
                <img :src="product.image" alt="">
                <p>{{ product.name }}</p>
                <p>{{ product.quantity }}</p>
                <p>{{ product.price }}€</p>
            </div>
            <p>Total:{{ ticket.total }}€</p>
            <button class="bg-black text-white py-1 px-2 rounded" @click="cancelar(ticket.id)">Cancelar</button>
        </div>
    </div>
    <Loader class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalLoader"></Loader>

</template>

<script>
import { useStores } from '~/stores/counter';
import axios from 'axios';
import Loader from '~/components/Loader.vue';

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
                const response = await axios.post(`http://localhost:8000/api/cancelar/${id}`, null, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

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
            const response = await axios.get('http://localhost:8000/api/tickets', {
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