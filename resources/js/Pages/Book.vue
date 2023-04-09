<script setup lang="ts">
import NavBar from '@/Components/App/NavBar.vue';
import Footer from '@/Components/App/Footer.vue';
import BookShow from '@/Components/App/BookShow.vue';

import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Book" />

    <div
        class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white"
    >
        <NavBar />
        <main class="relative z-10">
            <BookShow :id="id"/>
        </main>
        <Footer class="fixed bottom-0 left-0 z-20 w-full "/>
    </div>

</template>

<script lang="ts">
export default {
    props: {
        id: Number
    },
};
</script>