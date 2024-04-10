// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    "@nuxtjs/tailwindcss",
    "@pinia/nuxt",
    "@pinia-plugin-persistedstate/nuxt"
  ],
  routeRules: {
    '/tienda': {
      security: {
        headers: {
          crossOriginEmbedderPolicy: "unsafe-none",
        },
      },
    },
  }
})