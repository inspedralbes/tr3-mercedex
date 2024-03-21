<template>
    <div class="h-full w-full fixed inset-y-0 right-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
      <div class="bg-white p-4 shadow-md w-150 h-80">
        <h1 class="font-bold">Eliminar</h1>
        <h2 class="text-lg font-semibold mb-4">¿Estás seguro que quieres eliminar este producto?</h2>
        <div class="flex justify-center">
          <button class="mr-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded" @click="confirmarEliminacion">Sí, quitar</button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      confirmarEliminacion() {
        this.$emit('eliminar');
      },
      cancelarEliminacion() {
        this.$emit('cancelar');
      }
    }
  };
  </script>
  