<template>

    <div class="bg-black">
        <LoginHeader class="py-4"/>
    </div>
    <div v-if="!mostrarCompraExitosa">
        <form @submit.prevent="comprar" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div v-if="error" class="bg-red-500 text-white p-2 rounded">
                <p>{{ this.message }}</p>
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
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Comprar
                </button>
            </div>
        </form>
    </div>

    <Loader class="fixed top-0 left-0 w-full h-full" v-if="mostrarModalLoader"></Loader>
    <SuccessCompra v-if="mostrarCompraExitosa"></SuccessCompra>

</template>

<script>
import { useStores } from '~/stores/counter';
import axios from 'axios';
import Loader from '~/components/Loader.vue';
import SuccessCompra from '~/components/SuccessCompra.vue';
export default {
    data() {
        return {
            address: '',
            phone: '',
            TicketId: '',
            mostrarModalLoader: false,
            fetchOkey: false,
            mostrarCompraExitosa: false,
            error: false,
            message: '',
        };
    },
    methods: {
        async comprar() {
            this.mostrarModalLoader = true;
            const cart = useStores().cart;
            if (cart.length === 0) {
                this.mostrarModalLoader = false;
                this.error = true;
                this.message = 'El carrito está vacío'
                return;
            }
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

                console.log('Compra realizada?:', response.data.id);
                this.TicketId = response.data.id;
                this.fetchOkey = true;

            } catch (error) {
                console.error('Error:', error);
                this.error = true;
                this.message = error.response.data.message;
                this.mostrarModalLoader = false;
            }

            const items_2 = useStores().cart.map(item => ({
                productId: item.id,
                quantity: item.quantity
            }));

            const ticketId = this.TicketId;

            if (this.fetchOkey) {
                try {
                    const response = await axios.post(`http://localhost:8000/api/tickets_product/${ticketId}`, {
                        products: items_2,
                    }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });
                    console.log('Compra realizada?:', response.data);
                    this.mostrarModalLoader = false;
                    this.mostrarCompraExitosa = true; 
                } catch (error) {
                    console.error('Error:', error);
                    this.error = true;
                    this.message = error.response.data.message;
                    this.mostrarModalLoader = false;
                }
            }
        }
    }
}
</script>
