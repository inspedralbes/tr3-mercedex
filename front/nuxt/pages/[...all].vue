<template>
    <NuxtLayout name="404">
        <div class="w-full h-screen flex flex-col justify-center items-center gap-4">
            <div class="flex justify-center items-center">
                <h1 class="text-8xl">4</h1>
                <img src="../public/gif/car-loader.gif" alt="">
                <h1 class="text-8xl">4</h1>
            </div>
            <h2>Oh no! Page not found</h2>
            <NuxtLink to="/"
                class="bg-primary py-2 px-6 rounded-md text-sm font-semibold text-cWhite hover:bg-primary_dark transition duration-200 ease-in-out">
                Volver</NuxtLink>
        </div>
    </NuxtLayout>
</template>

<script>
export default {

}
</script>