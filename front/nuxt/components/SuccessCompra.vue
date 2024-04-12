<template>
  <div>
    <article class="flex flex-col justify-center items-center gap-2 mt-4">
      <div class="mt-20">
        <h1 class="text-center font-bold text-5xl">Resumen de tu compra</h1>
        <hr class="h-[5px] bg-black w-100 mb-20">
    </div>
      <h1 class="font-semibold text-3xl">Compra realizada con éxito</h1>
      <p>Gracias por confiar en nosotros</p>
      <img src="../public/img/check_image.png" class="w-[100px] h-[100px] mb-10" alt="">
      <NuxtLink to="/tickets" class="px-4 py-1 bg-black text-white rounded-md mb-20">
        <button class="text-lg">Ver mi pedido</button>
      </NuxtLink>
    </article>

    <div v-if="cart.length > 0" class="overflow-y-auto w-[70%] mx-auto mt-4">
      <ul class="flex flex-col gap-4 border-b pb-8 mb-8">
        <li v-for="(item, index) in cart" :key="index">
          <div class="flex justify-between">
            <img :src="item.image" class="size-32 object-contain bg-slate-200" alt="Imagen del producto">
            <div class="flex flex-col w-full gap-y-6 justify-between px-2">
              <h3 class="text-sm font-semibold">{{ item.name }}</h3>
              <div class="w-full flex justify-center items-center">
                <p class="w-full text-left">Cantidad: {{ item.quantity }}</p>
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

  },
  computed: {
    cart() {
      console.log(this.store.getResumenCart());
      this.store.mostrarCartModal = false;
      return this.store.getResumenCart();
    }
  }
}
</script>