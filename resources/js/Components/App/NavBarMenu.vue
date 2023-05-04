<template>
    <div class="block sm:hidden">
        <button @click="toggleNavbar()" class="flex items-center px-3 py-2 text-white border border-white rounded text-teal-lighter">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div :class="{'hidden': !this.showMenu, 'flex': this.showMenu}" class="flex-col items-start w-full sm:flex-row sm:flex sm:items-center sm:w-auto">
        <div class="flex items-baseline flex-grow space-x-4 sm:ml-10">
            <NavBarMenuLink :link="'/'" :text="'Home'" />
            <NavBarMenuLink :link="'/books'" :text="'Book'" />
            <NavBarMenuLink :link="'/contact'" :text="'Contact'" />
        </div>
        <div class="mt-4 sm:items-center sm:ml-6 sm:mt-0 sm:flex">
            <NavBarSearchForm />

            <div v-if="$page.props.auth.user" class="flex justify-center mt-3 sm:mt-0">
                <NavBarDropdown :button-label="$page.props.auth.user.name" />
            </div>

            <div v-else class="flex justify-center mt-3 ml-1 sm:mt-0">
                <a href="/login" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white">Login</a>
                <a href="/register" class="px-3 py-2 ml-4 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Register</a>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import { defineComponent, ref } from 'vue'
    import NavBarSearchForm from './NavBarSearchForm.vue'
    import NavBarMenuLink from './NavBarMenuLink.vue'
    import NavBarDropdown from './NavBarDropdown.vue'
    import { usePage } from '@inertiajs/vue3'

    export default defineComponent({
        name: "app-navbar-menu",
        components: {
            NavBarMenuLink,
            NavBarSearchForm,
            NavBarDropdown
        },
        setup() {
            const showMenu = ref(false)
            const page = usePage()

            const toggleNavbar = () => {
                showMenu.value = !showMenu.value
            }

            return {
                showMenu,
                toggleNavbar,
                page
            }
        },
    })
</script>