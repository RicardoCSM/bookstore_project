<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';
import Footer from '@/Components/App/LayoutComponents/Footer.vue';
import BookList from '@/Components/App/BookComponents/BookList.vue';

import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Books" />

    <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
        <NavBar />
        <main class="relative z-10">
            <BookList />
        </main>
        <Footer class="relative bottom-0 left-0 z-20 w-full mt-6" />
    </div>
</template>