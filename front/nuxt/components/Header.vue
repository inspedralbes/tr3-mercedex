<template>
    <div class="flex justify-between items-center px-20 py-6 ">
        <img class="size-16" src="../public/img/mercedes-logo.png" alt="">
        <nav class="flex justify-center gap-x-20 text-white font-semibold [&>a:hover]:text-green-300 [&>a]:transition">
            <NuxtLink to="/modelos">Nuestros modelos</NuxtLink>
            <NuxtLink to="/buscar">Buscar</NuxtLink>
            <NuxtLink to="/asesoramiento">Asesoramiento</NuxtLink>
            <NuxtLink to="/servicios">Servicios</NuxtLink>
            <NuxtLink to="/accesorios">Accesorios</NuxtLink>
            <NuxtLink to="/tecnologia">Tecnología</NuxtLink>
        </nav>
        <div class="flex gap-x-3 text-white [&>a:hover]:text-green-300 [&>a]:transition">
            <NuxtLink to="/questions">
                <HelpIcon />
            </NuxtLink>
            <!-- Lenguage Flag -->
            <NuxtLink to="/login">
                <UserIcon />
            </NuxtLink>
            <NuxtLink to="/tienda" @click="mostrarCarritoModal">
                <CartIcon />
            </NuxtLink>
        </div>
        <!-- Otros elementos del header -->
        <CartModal v-if="mostrarModal" :carrito="carrito" :cerrarModal="cerrarModal" />
    </div>
</template>

<script>
import CartModal from '@/components/CartModal.vue';

export default {
    components: {
        CartModal
    },
    props: {
        carrito: {
            type: Array,
            default: () => []
        }
    },
    data() {
        return {
            mostrarModal: false
        }
    },
    methods: {
        mostrarCarritoModal() {
            this.mostrarModal = true;
        },
        cerrarModal() {
            this.mostrarModal = false;
        }
    }
}
</script>