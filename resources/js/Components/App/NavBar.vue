<template>
    <div class="font-sans antialiased" id="app">
        <nav class="flex flex-wrap items-center justify-between p-4 bg-gray-800">
            <NavBarLogo />
            <NavBarMenu />
        </nav>
    </div>
</template>

<script lang="ts">
    import { defineComponent} from 'vue'
    import NavBarLogo from '@/Components/App/NavBarLogo.vue'
    import NavBarMenu from '@/Components/App/NavBarMenu.vue'

    export default defineComponent({
        components: {
            NavBarLogo,
            NavBarMenu
        }
    })
</script>