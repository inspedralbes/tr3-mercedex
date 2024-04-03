<template>
    <div class="bg-black">
        <Header />
    </div>
    <form @submit.prevent="comprar" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
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
import { useStores } from '~/stores/counter';
import axios from 'axios';

export default {
    data() {
        return {
            address: '',
            phone: ''
        };
    },
    methods: {
        async comprar() {
            const items = useStores().cart.map(item => ({
                id: item.id,
                quantity: item.quantity
            }));
            const token = useStores().userInfo.token;
            console.log(`Bearer ${token}`);
            try {
                console.log("Compra realizada con éxito");

                const response = await axios.post('http://localhost:8000/api/ventas', {
                    address: this.address,
                    phone: this.phone,
                    items
                }, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });

                console.log('Compra realizada?:', response.data);

            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
}
</script>
