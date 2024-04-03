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
            <p>Total:{{ ticket.total }}€</p>
            <button class="bg-black text-white py-1 px-2 rounded" @click="cancelar(ticket.id)">Cancelar</button>
        </div>
    </div>
</template>

<script>
import { useStores } from '~/stores/counter';
import axios from 'axios';

export default {
    data() {
        return {
            tickets: []
        }
    },
    methods: {
        async cancelar(id) {
            const token = useStores().userInfo.token;
            if (!token) {
                console.error("No se encontró el token de autenticación.");
                return;
            }

            try {
                const response = await axios.post(`http://localhost:8000/api/cancelar/${id}`, null, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                console.log("Respuesta:", response.data);
            } catch (error) {
                console.log('Error:', error);
            }
        },

    },
    async mounted() {
        const token = useStores().userInfo.token;
        if (!token) {
            console.error("No se encontró el token de autenticación.");
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
        } catch (error) {
            console.error('Error:', error);
        }
    }

}
</script>