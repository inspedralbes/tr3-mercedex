<template>
    <div class="flex justify-between px-20 items-center text-white">
        <button @click="$router.go(-1)"><ArrowLeftIcon/></button>
        <MercedesLogo class="size-16"/>
        <SelectLanguage/>
    </div>
</template>
