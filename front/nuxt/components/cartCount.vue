<template>
    <div class="relative">
        <CartIcon />
        <span 
        class="flex justify-center items-center text-white bg-green-500 rounded-full size-5 text-xs absolute -top-2 -right-2"
        v-if="count > 0"
        >{{ count }}</span>
    </div>
</template>

<script>
import { useStores } from '@/stores/counter';
import {computed} from 'vue';

    export default {
        data() {
            const cart = useStores();

            return {
                count: computed(() => cart.cartCount)
            }
        },

        methods: {

        },
        
    }
</script>