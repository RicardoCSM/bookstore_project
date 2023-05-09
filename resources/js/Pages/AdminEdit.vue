<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';
import AuthorEditForm from '@/Components/App/AdminComponents/AuthorEditForm.vue';
import PublisherEditForm from '@/Components/App/AdminComponents/PublisherEditForm.vue';
import BookEditForm from '@/Components/App/AdminComponents/BookEditForm.vue';

import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
  content: {
    type: Number,
    required: true
  },
  id: {
    type: Number
  }
})
</script>

<template>
    <Head title="Edit" />

    <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
        <NavBar />

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden md:rounded-lg">
                <div class="py-2" v-if="content === 1">
                    <BookEditForm :book_id="id"/>
                </div>
                <div class="py-6" v-if="content === 2">
                    <AuthorEditForm :author_id="id"/>
                </div>
                <div class="py-6" v-if="content === 3">
                    <PublisherEditForm :publisher_id="id"/>
                </div>
            </div>
        </div>

    </div>
</template>