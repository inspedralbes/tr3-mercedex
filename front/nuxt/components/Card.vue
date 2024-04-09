<template>
    <div class="flex flex-col justify-start items-start rounded-md overflow-hidden bg-slate-900 w-80 gap-4">
        <img class="w-full h-56 object-cover"
            :src="image"
            :alt="`Imagen de ${title}`">
        <div class="px-4 pb-10">
            <h3 class="font-semibold mb-2">{{ title }}</h3>
            <p class="text-sm">{{ text }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        image: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        text: {
            type: String,
            required: true
        }
    }

}
</script>