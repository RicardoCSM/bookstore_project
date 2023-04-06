<script setup lang="ts">
import NavBar from '@/Components/App/NavBar.vue';
import IndexBanner from '@/Components/App/IndexBanner.vue';
import IndexSection from '@/Components/App/IndexSection.vue';
import Footer from '@/Components/App/Footer.vue';

import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Index" />

    <div
        class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white"
    >
        <NavBar />
        <main class="relative z-10">
            <IndexBanner />
            <IndexSection />
        </main>
        <Footer class="relative bottom-0 left-0 z-20 w-full"/>
    </div>

</template>
