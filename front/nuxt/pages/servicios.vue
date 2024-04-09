<template>
    <div class="w-full h-screen relative">
        <Header class="w-full absolute top-0 left-0 z-50" />

        <img class="w-full h-full object-cover brightness-50"
            src="https://fotografias.lasexta.com/clipping/cmsimages01/2018/02/28/74F56C22-0641-4079-B245-78FCC965B329/98.jpg?crop=1440,810,x0,y0&width=1900&height=1069&optimize=high&format=webply"
            alt="">
        <div class="absolute top-1/3 left-36 text-cWhite flex flex-col gap-2 items-start">
            <h2 class="text-6xl font-semibold">Pedir cita está en tu mano.</h2>
            <p class="w-2/3 text-lg">Reserva tus mantenimientos, reparaciones u otros servicios de manera cómoda con tu
                taller Mercedes-Benz
                más cercano.</p>
            <NuxtLink to="https://www.mercedes-benz.es/passengercars/services/online-appointment-booking.html#/"
                class="bg-[#E7E9CC] px-10 py-2 border-2 border-[#E7E9CC] rounded-md font-semibold text-cBlack  hover:border-2 hover:border-cBlack hover:bg-cWhite transition duration-200" target="_blank">Pedir
                cita</NuxtLink>

        </div>
    </div>

    <div class="w-full h-screen relative">
        <Header class="w-full absolute top-0 left-0" />
        <img class="w-full h-full object-cover brightness-50"
            src="https://www.mercedes-benz.es/content/spain/es/passengercars/services/breakdown-damage/_jcr_content/root/responsivegrid/simple_stage.component.damq6.3306497279970.jpg/GSP-PC514254.jpg"
            alt="">
        <div class="absolute top-1/2 -translate-y-1/2 left-36 text-cWhite flex flex-col gap-2 items-start">
            <h2 class="text-6xl font-semibold w-2/3">Mercedes-Benz te ayuda
                en caso de avería o desperfecto.
            </h2>
            <p class="w-2/3 text-lg">Ayuda exhaustiva del fabricante.</p>
            <div class="grid grid-cols-3 gap-4 justify-start">
                <Card 
                title="Servicio de atención al cliente"
                text="Puedes contactarnos siempre que quieras llamando al teléfono: 00800 9 777
                            7777 y/o a +34 91 375
                            30 67. Las personas con discapacidad auditiva total o parcial pueden solicitar ayuda en
                            carretera por medio de la siguiente dirección de e-mail: cs.esp@cac.mercedes-benz.com"
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/breakdown-damage/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item.component.damq6.3357798112861.jpg/GSP-PC514261.jpg"
                />

                <Card 
                title="Tecla SOS"
                text="La tecla SOS situada en la unidad de mando en el techo de tu vehículo
                            establece conexión inmediata con la central de llamadas de emergencia Mercedes-Benz."
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/breakdown-damage/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item_c_1177294851.component.damq6.3306947814454.jpg/GSP-PC514265.jpg"
                />

                <Card 
                title="Mercedes me connect"
                text="Basta con pulsar para obtener ayuda: la tecla Mercedes me de la agenda de
                            teléfonos de tu vehículo o de la unidad de mando en el techo te comunica directamente con
                            uno de nuestros empleados de servicio posventa."
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/breakdown-damage/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item_c_1681941052.component.damq6.3306948203332.jpg/GSP-PC514266.jpg"
                />

            </div>
        </div>
    </div>

    <div class="w-full h-screen relative">
        <Header class="w-full absolute top-0 left-0" />
        <img class="w-full h-full object-cover brightness-50"
            src="https://www.mercedes-benz.es/content/spain/es/passengercars/services/mercedes-me/apps/_jcr_content/root/responsivegrid/simple_stage.component.damq6.3326062826684.jpg/imgstageappoverview.jpg"
            alt="">
        <div class="absolute top-1/2 -translate-y-1/2 left-36 text-cWhite flex flex-col gap-2 items-start">
            <h2 class="text-6xl font-semibold">Siempre conectado con tu Mercedes-Benz.</h2>
            <p class="w-2/3 text-lg">Las Mercedes me Apps te hacen la vida más fácil.</p>
            <div class="grid grid-cols-3 gap-4 justify-start">
                <Card 
                title="Mercedes me finance App"
                text="Con la nueva App, Mercedes me finance, tienes a mano la posibilidad de
                            revisar tus datos personales y bancarios, gestionar tus contratos financieros y de Renting o
                            contactar con Atención al Cliente de Servicios Financieros en un momento."
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/mercedes-me/apps/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item_100322063.component.damq6.3354542119822.jpg/financiera_mercedes_me_1920x1080_022023.jpg"
                />

                <Card 
                title="Mercedes me App"
                text="Conéctate con tu Mercedes-Benz y configura la pantalla de inicio de la
                            Mercedes me App de modo que encuentres tus funciones favoritas de forma más rápida y
                            sencilla. Tanto si quieres comprobar la presión de inflado de los neumáticos como saber
                            cuántos kilómetros puedes recorrer con el nivel de llenado de tu depósito o acumulador de
                            energía, con la Mercedes me App tienes siempre tu Mercedes-Benz bajo control.⁣ Ahora,
                            además, puedes encontrar las recomendaciones para Digital Extras y comprarlas con la
                            Mercedes me App."
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/mercedes-me/apps/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item.component.damq6.3342970601742.jpg/imgLPsimpleteaser3mme.jpg"
                />

                <Card 
                title="Mercedes me Store App"
                text="Encuentra todos los extras digitales para tu vehículo sin pérdida de tiempo
                            en el Mercedes me Store. Se muestran de forma clara todas las Apps o informaciones nuevas,
                            así como los plazos de vigencia y los contratos. Naturalmente, estos últimos pueden
                            prolongarse fácilmente desde aquí."
                image="https://www.mercedes-benz.es/content/spain/es/passengercars/services/mercedes-me/apps/_jcr_content/root/responsivegrid/simple_teaser/simple_teaser_item_136643552.component.damq6.3335636627012.jpg/imgLPsimpleteaser3mmestore.jpg"
                />

            </div>
        </div>
    </div>

</template>

<script>
export default {

}
</script>