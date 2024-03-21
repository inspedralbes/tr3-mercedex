<template>
    <div class="bg-black">
        <Header />
    </div>
    <form @submit.prevent="comprar" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Nombre
            </label>
            <input v-model="name"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="name" type="text" placeholder="Nombre">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                Apellido
            </label>
            <input v-model="lastname"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="lastname" type="text" placeholder="Apellido">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                Estado
            </label>
            <input v-model="status"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="status" type="text" placeholder="Estado">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                Dirección
            </label>
            <input v-model="address"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="address" type="text" placeholder="Dirección">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                Teléfono
            </label>
            <input v-model="phone"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="phone" type="text" placeholder="Teléfono">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input v-model="email"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="email" type="email" placeholder="Email">
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Comprar
            </button>
        </div>
    </form>
</template>

<script>
import { useCartStore } from '~/stores/counter';
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            lastname: '',
            status: '',
            address: '',
            phone: '',
            email: ''
        };
    },
    methods: {
        async comprar() {
            const items = useCartStore().cart.map(item => ({
                id: item.id,
                quantity: item.quantity
            }));

            try {
                console.log("Compra realizada con éxito");

                const response = await axios.post('http://localhost:8000/api/ventas', {
                    name: this.name,
                    lastname: this.lastname,
                    status: this.status,
                    address: this.address,
                    phone: this.phone,
                    email: this.email,
                    items
                });
                console.log('Compra realizada?:', response.data);

            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
}
</script>
