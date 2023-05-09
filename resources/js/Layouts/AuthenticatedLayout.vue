<script setup>
import { ref } from 'vue';
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';

</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-900">
            
            <NavBar />

            <!-- Page Heading -->
            <header class="bg-gray-800 shadow" v-if="$slots.header">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
