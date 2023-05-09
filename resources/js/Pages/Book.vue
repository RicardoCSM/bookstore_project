<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';
import Footer from '@/Components/App/LayoutComponents/Footer.vue';
import BookShow from '@/Components/App/BookComponents/BookShow.vue';

import { Head } from '@inertiajs/vue3';

const props = defineProps({
  id: {
    type: Number,
    required: true
  }
});

</script>

<template>
  <Head title="Book" />

  <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
    <NavBar />
    <main class="relative z-10">
      <BookShow :id="props.id" />
    </main>
    <Footer class="fixed bottom-0 left-0 z-20 w-full " />
  </div>
</template>