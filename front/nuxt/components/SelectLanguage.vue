<template>
<div id="dropdownLanguage" class="relative">
  <button class="rounded-full focus:ring-2 focus:outline-none focus:ring-gray-400"><img class="size-6 rounded-full object-cover" src="../public/img/flags/spain.jpg" alt=""></button>

    <div class="absolute mt-10 rounded-lg shadow-lg">
      <button class="flex gap-x-2 items-center justify-center w-full px-2 py-2 text-left hover:bg-blue-500"><img class="size-6 rounded-full object-cover" src="../public/img/flags/usa.png" alt=""> English</button>
      <button class="flex items-center w-full px-4 py-2 text-left hover:bg-blue-500">Español</button>
      <button class="flex items-center w-full px-4 py-2 text-left hover:bg-blue-500">Deutsch</button>
      <button class="flex items-center w-full px-4 py-2 text-left hover:bg-blue-500">Français</button>
    </div>
  </div>
</template>

<script>
  export default {
    
  }
</script>