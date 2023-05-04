<template>
    <div class="font-sans antialiased">
        <nav class="flex flex-wrap items-center justify-between p-4 bg-gray-800 bg-opacity-90">
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