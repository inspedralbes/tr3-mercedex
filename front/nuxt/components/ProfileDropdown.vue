<template>
    <div id="language-container" class="relative my-auto">
        <button
            class="flex items-center justify-center rounded-full focus:ring-2 focus:outline-none focus:ring-gray-400"
            @click="dropDown()">
            <UserIcon />
        </button>

        <div id="dropdownLanguage"
            :class="{ 'absolute flex flex-col justify-center items-start gap-2 right-0 mt-2 w-max rounded-lg shadow-lg bg-slate-400/50 overflow-hidden modal': true, 'isOpen': isOpen }">

            <NuxtLink to="/tickets"
                class="flex items-center justify-start gap-2 w-full px-3 py-2 text-sm hover:bg-blue-500">
                <TicketIcon class="size-4" /> Tickets
            </NuxtLink>
            <NuxtLink to="/profile"
                class="flex items-center justify-start gap-2 w-full px-3 py-2 text-sm hover:bg-blue-500">
                <UserconfIcon class="size-4" /> Perfil
            </NuxtLink>
            <Button @click="Logout()"
                class="flex items-center justify-start gap-2 w-full px-3 py-2 text-sm hover:bg-blue-500">
                <LogoutIcon class="size-4" /> Logout
            </Button>
        </div>
    </div>
</template>

<script>
import { useStores } from '@/stores/counter';
import axios from 'axios';
import { computed } from 'vue'

export default {
    data() {
        const cart = useStores();

        return {
            isOpen: false,
            flagUrl: computed(() => cart.flag)
        }
    },
    methods: {
        dropDown() {
            this.isOpen = !this.isOpen
        },
        Logout() {
            const store = useStores();
            const token = useStores().userInfo.token;
            console.log(`Bearer ${token}`);
            try {
                const response = axios.post('http://localhost:8000/api/logout', {}, {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                console.log(response);
                store.setLoggedIn(false);
                store.userInfo = {};
            } catch (error) {
                console.error('Error:', error);
            }
        }
    }
}
</script>

<style>
.modal {
    max-height: 0;
    transition: max-height .3s ease-in-out;
}

.isOpen {
    max-height: 200px;
}
</style>