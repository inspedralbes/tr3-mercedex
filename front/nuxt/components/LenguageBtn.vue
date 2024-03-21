<template>
    <button class="flex gap-x-2 items-center px-4 justify-start w-full py-2 hover:bg-blue-500">
        <img class="size-5 rounded-full object-cover" :src="flag" :alt="'Bandera del idioma ' + language">
        <p class="text-sm">{{ language }}</p>

    </button>
</template>

<script>
export default {
    props: {
        flag: {
            type: String,
            required: true
        },
        language: {
            type: String,
            required: true
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
