<template>
    <div class="bg-black">
        <Header />
    </div>
    <div class="mt-20">
        <h1 class="text-center font-bold text-5xl">Modelos</h1>
    </div>
    <div class="px-4 mt-12">
        <div class="flex justify-center items-center">
            <div class="border-b-2 border-blue-500 mb-5">
                <button @click="mostrarDiv('Todo')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Todo' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Todo</button>
                <button @click="mostrarDiv('Berlina')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Berlina' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Berlina</button>
                <button @click="mostrarDiv('SUV & Todoterreno')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'SUV & Todoterreno' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">SUV & Todoterreno</button>
                <button @click="mostrarDiv('Estate')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Estate' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Estate</button>
                <button @click="mostrarDiv('Compacto')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Compacto' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Compacto</button>
                <button @click="mostrarDiv('Coupé')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Coupé' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Coupé</button>
                <button @click="mostrarDiv('Cabrio')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Cabrio' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Cabrio</button>
                <button @click="mostrarDiv('Monovolumen')"
                    :class="{ 'border-b-4 border-blue-500': mostrarCategoria === 'Monovolumen' }"
                    class="px-4 py-2 mx-1 my-0 font-bold">Monovolumen</button>
            </div>
        </div>





        <div v-if="mostrarCategoria === 'Todo'" class="mt-4">
            <div class="grid grid-cols-4 gap-2">
                <div class="bg-white m-9 p-6 rounded-lg shadow-lg shadow-xl flex justify-center items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-center mb-2 mt-2">EQE Berlina</h2>
                        <img class="mt-10"
                            src="https://assets.oneweb.mercedes-benz.com/iris/iris.png?COSY-EU-100-1713d0VXq0WFqtyO67PobzIr3eWsrrCsdRRzwQZgk4ZbMw3SGtGyWtsd0o9cUfpUWXGEuiRJ0l3IrOB2Nz2bApj7oI5uxoMQC31grkzNwtnm7jA2jhKViSF%25vq4vZyLRgY2YaxPtxrH1yC%25n8w0hyoiZBJYM4FvIFTg9Lt26PDa1FSeWHn3tsd8BQcUfiA1XGE5nmJ0lCrnOIJtR1q0goiZCkuM4F8CQTg9jiw6PDe7oSeWsKjtsdUvGcUaqKDTb32VXq0J70tef%25XEd9BBpxb1loE1JnwxV4V%25d%25CWLH59zW0uB16E1&imgt=P27&bkgnd=9&pov=BE140&uni=cs&im=Crop,rect=(0,0,1450,750),gravity=Center;Resize,width=300"
                            alt="">
                        <div class="flex justify-center items-center">
                            <p class="text-sm text-white bg-blue-500 rounded-full inline-block px-3 py-1">Eléctrico</p>
                        </div>
                    </div>
                </div>


                <div class="bg-white m-6 p-6 rounded-lg shadow-lg shadow-xl flex justify-center items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-center mb-2 mt-2">Clase E Berlina</h2>
                        <img class="mt-10"
                            src="https://assets.oneweb.mercedes-benz.com/iris/iris.png?COSY-EU-100-1713d0VXqNWFqtyO67PobzIr3eWsrrCsdRRzwQZgk4ZbMw3SGtxmFtsd2HdcUfpMqXGEu5EJ0lVHxOB2sW2bApvnyI5uL5qQC3aspkzNIUbm7jgcmhKVPX9%25vqeIkyLR5cRYaxCNqrH1zmrn8w7oboiZKeXM4FsQkTSMrp3261m7jsFI5Tj49QCbTNDkzeGVWm7hmVdhK%25tef%25vycYEyLYXxlYarIa2rb0XvdNe4Gp0oEyZlaH1p8aKMMgAN5iD85u9CAGmG1a1SLOI6KtLoPM5f85&imgt=P27&bkgnd=9&pov=BE140&uni=cs&im=Crop,rect=(0,0,1450,750),gravity=Center;Resize,width=300"
                            alt="">
                        <div class="flex justify-center items-center">
                            <p
                                class="text-sm text-white bg-gradient-to-r from-green-500 to-blue-500 rounded-full inline-block px-3 py-1">
                                Híbrido</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="mostrarCategoria === 'Berlina'" class="mt-4">
            <p>Berlina</p>
        </div>


        <div v-else-if="mostrarCategoria === 'SUV & Todoterreno'" class="mt-4">
            <p>SUV & Todoterreno</p>
        </div>


        <div v-else-if="mostrarCategoria === 'Estate'" class="mt-4">
            <p>Estate</p>
        </div>


        <div v-else-if="mostrarCategoria === 'Compacto'" class="mt-4">
            <p>Compacto</p>
        </div>


        <div v-else-if="mostrarCategoria === 'Coupé'" class="mt-4">
            <p>Coupé</p>
        </div>


        <div v-else-if="mostrarCategoria === 'Cabrio'" class="mt-4">
            <p>Cabrio</p>
        </div>


        <div v-else-if="mostrarCategoria === 'Monovolumen'" class="mt-4">
            <p>Monovolumen</p>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            mostrarCategoria: 'Todo'
        };
    },
    methods: {
        mostrarDiv(categoria) {
            this.mostrarCategoria = categoria;
        }
    }
}
</script>
