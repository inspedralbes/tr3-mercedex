<template>
  <div id="language-container" class="relative my-auto">
    <button class="flex items-center justify-center rounded-full focus:ring-2 focus:outline-none focus:ring-gray-400"
      @click="dropDown()"><img class="size-5 rounded-full object-cover" :src="flagUrl" alt="">
    </button>

    <div id="dropdownLanguage"
      :class="{ 'absolute right-0 mt-2 w-max  rounded-lg shadow-lg bg-slate-400/50 overflow-hidden modal': true, 'isOpen': isOpen }">
      <LenguageBtn @click="changeLanguage('usa', 'png')" flag="/img/flags/usa.png" language="English" />
      <LenguageBtn @click="changeLanguage('italy', 'png')" flag="/img/flags/italy.png" language="Italiano" />
      <LenguageBtn @click="changeLanguage('france', 'png')" flag="/img/flags/france.png" language="Français" />
      <LenguageBtn @click="changeLanguage('spain', 'jpg')" flag="/img/flags/spain.jpg" language="Español" />
    </div>
  </div>
</template>

<script>
import { useStores } from '@/stores/counter';
import { computed } from 'vue'

export default {
  data() {
    const cart = useStores();

    return {
      isOpen: false,
      flagUrl: computed(() => cart.flag)
    }
  },
  methods: {
    dropDown() {
      this.isOpen = !this.isOpen
    },

    changeLanguage(value, extension) {
      const cart = useStores();

      const newFlagUrl = `/img/flags/${value}.${extension}`;
      cart.setFlag(newFlagUrl);

      this.dropDown();
    }
  }
}
</script>

<style>
.modal {
  max-height: 0;
  transition: max-height .3s ease-in-out;
}

.isOpen {
  max-height: 200px;
}
</style>