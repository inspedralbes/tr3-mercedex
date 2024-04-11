<template>
  <div class="h-full w-full fixed inset-y-0 right-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
    <div class="bg-white p-4 shadow-md px-8 py-8 flex flex-col justify-center items-center rounded-md">
      <h2 class="text-lg font-semibold mb-4">¿Estás seguro que quieres eliminar este producto?</h2>
      <div
        class="flex justify-center items-center gap-4 [&>button]:text-white [&>button]:text-sm [&>button]:font-semibold [&>button]:rounded-md [&>button]:py-2 [&>button]:px-4 [&>button]:transition [&>button]:duration-200 [&>button]:ease-in-out [&>button:hover]:-translate-y-1">
        <button class="bg-primary hover:bg-primary_dark" @click="confirmarEliminacion">Sí, quitar</button>
        <button class="bg-red-500 hover:bg-red-600" @click="cancelarEliminacion">Cancelar</button>
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
      useStores().mostrarConfirmationModal = false;
    }
  }
};
</script>