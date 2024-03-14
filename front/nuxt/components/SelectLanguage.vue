<template>
  <div id="language-container" class="relative">
    <button class="flex items-center justify-center rounded-full focus:ring-2 focus:outline-none focus:ring-gray-400"
      @click="dropDown()"><img class="size-5 rounded-full object-cover" src="../public/img/flags/spain.jpg"
        alt=""></button>

    <div id="dropdownLanguage"
    :class="{ 'absolute mt-2 w-max  rounded-lg shadow-lg bg-slate-400/50 overflow-hidden modal': true, 'isOpen': isOpen}">
      <LenguageBtn flag="/img/flags/usa.png" language="English" />
      <LenguageBtn flag="/img/flags/italy.png" language="Italiano" />
      <LenguageBtn flag="/img/flags/france.png" language="Français" />
      <LenguageBtn flag="/img/flags/spain.jpg" language="Español" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false
    }
  },
  methods: {
    dropDown() {
      console.log('click')
      this.isOpen = !this.isOpen
    }
  }
}
</script>

<style>


.modal{
  max-height: 0;
  transition: max-height .3s ease-in-out;
}

.isOpen{
  max-height: 200px;
}
</style>