<template>
    <div>
        <h1>Compra realizada con éxito</h1>
        <p>Gracias por confiar en nosotros</p>
        <NuxtLink to="/tienda">
                <button @click="volver()">Volver</button>
        </NuxtLink>

        <div v-if="cart.length > 0" class="overflow-y-auto">
        <ul class="flex flex-col gap-4 border-b pb-8 mb-8">
          <li v-for="(item, index) in cart" :key="index">
            <div class="flex justify-between">
              <img :src="item.image" class="size-32 object-contain bg-slate-200" alt="Imagen del producto">
              <div class="flex flex-col w-full gap-y-6 justify-between px-2">
                <h3 class="text-sm font-semibold">{{ item.name }}</h3>
                <div class="w-full flex justify-center items-center">
                  <p class="w-full text-left">{{ item.quantity }}</p>
                </div>
                <div class="flex justify-between items-center">
                  <p class="text-sm font-semibold">{{ item.price }}€</p>
                </div>
              </div>

            </div>
          </li>
        </ul>
      </div>

    </div>
</template>                    

<script>
import { useStores } from '~/stores/counter';
import axios from 'axios';
import Loader from '~/components/Loader.vue';

export default {
  data() {
    const store = useStores();
    return {
      store,
      mostrarCartModal: computed(() => store.mostrarCartModal),
    };
  },
  methods: {
    volver() {
      this.store.clearCart();
    }
  },
  computed: {
    cart() {
      return this.store.getCart();
    }
  }
}
</script>