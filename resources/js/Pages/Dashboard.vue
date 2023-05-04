<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <div
        class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white"
    >
        <NavBar />
        
        <Footer class="fixed bottom-0 left-0 z-20 w-full "/>
    </div>
</template>
