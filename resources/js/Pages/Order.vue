<script setup lang="ts">
import NavBar from '@/Components/App/NavBar.vue';
import Footer from '@/Components/App/Footer.vue';
import OrderShow from '@/Components/App/OrderShow.vue';

import { Head } from '@inertiajs/vue3';

const props = defineProps({
  id: {
    type: Number,
    required: true
  }
});

</script>

<template>
    <Head title="Order" />

    <div
        class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white"
    >
        <NavBar />
        <main class="relative z-10">
            <OrderShow :id="id"/>
        </main>
        <Footer class="fixed bottom-0 left-0 z-20 w-full "/>
    </div>

</template>