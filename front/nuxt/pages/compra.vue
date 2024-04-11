<template>

    <div class="bg-black">
        <LoginHeader class="py-4" />
    </div>
    
    <div v-if="!mostrarCompraExitosa">
    <div class="mt-30 flex flex-col justify-center items-center gap-2 mt-4">
        <h1 class="text-center font-bold text-5xl mt-5">Formulario de Compra</h1>
        <hr class="h-[5px] bg-black w-[100px] mt-5">
    </div>
    <section class="flex justify-center items-center gap-y-8 h-[80vh]">
        <div class="bg-[#1E1E1E] flex flex-col justify-center items-center py-8 px-6 relative w-[30%] h-[80%]">
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-center font-bold text-3xl text-white mb-5">Rellena los datos de envío!</h1>
                <img src="../public/img/mercedes-logo.png" alt="">
            </div>
            <form @submit.prevent="comprar" class="flex flex-col gap-y-4 items-center w-[80%] ">

                <div v-if="error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ this.message }}</span>
                </div>

                <input class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0 text-white" type="text" placeholder="ej: C/ nombre, Nº, piso" v-model="address">

                <input class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0 text-white" type="text" placeholder="Teléfono" v-model="phone" @input="phone = $event.target.value.replace(/[^0-9]/g, '')">

                <input class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0 text-white" type="text" placeholder="Código Postal" v-model="postal_code" @input="postal_code = $event.target.value.replace(/[^0-9]/g, '')">

                <input class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0 text-white" type="text" placeholder="Ciudad" v-model="city">

                <input class="w-full border-b-2 border-white bg-transparent py-2 pl-2 focus:border-blue-300 outline-0 text-white" type="text" placeholder="País" v-model="country">

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Comprar</button>
                </div>

            </form>
        </div>
    </section>
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
            postal_code: '',
            city: '',
            country: '',
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
            if (this.address === '' || this.phone === '' || this.postal_code === '' || this.city === '' || this.country === '') {
                this.error = true;
                this.message = 'Por favor, rellena todos los campos';
                this.mostrarModalLoader = false;
                return;
            }
            try {
                console.log("Compra realizada con éxito");

                const response = await axios.post('http://localhost:8000/api/ventas', {
                    address: this.address,
                    phone: this.phone,
                    postal_code: this.postal_code,
                    city: this.city,
                    country: this.country,
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
                    const store = useStores();
                    store.setCarttoArray();
                    store.clearCart();
                    console.log('Carrito limpio', store.cart);
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
