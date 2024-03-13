<template>
    <div class="flex justify-between items-center px-20 py-6 ">
        <img class="size-16" src="../public/img/mercedes-logo.png" alt="">
        <nav class="flex justify-center gap-x-20 text-white font-semibold [&>a:hover]:text-green-300 [&>a]:transition">
                    <NuxtLink to="/modelos">Nuestros modelos</NuxtLink>
                    <NuxtLink to="/buscar">Buscar</NuxtLink>
                    <NuxtLink to="/asesoramiento">Asesoramiento</NuxtLink>
                    <NuxtLink to="/servicios">Servicios</NuxtLink>
                    <NuxtLink to="/accesorios">Accesorios</NuxtLink>
                    <NuxtLink to="/tecnologia">Tecnología</NuxtLink>
        </nav>
        <div class="flex gap-x-3 items-center justify-center text-white [&>a:hover]:text-green-300 [&>a]:transition">
            <NuxtLink to="/questions"><HelpIcon/></NuxtLink>
            <SelectLanguage/>
            <NuxtLink to="/login"><UserIcon/></NuxtLink>
        </div>
    </div>
</template>

<script>
export default {
    setup () {
        

        return {}
    }
}
</script>

<style lang="scss" scoped>

</style>