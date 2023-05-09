<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';
import AuthorForm from '@/Components/App/AdminComponents/AuthorForm.vue';
import PublisherForm from '@/Components/App/AdminComponents/PublisherForm.vue';
import BookForm from '@/Components/App/AdminComponents/BookForm.vue';
import BookAuthorForm from '@/Components/App/AdminComponents/BookAuthorForm.vue';
import BookImageForm from '@/Components/App/AdminComponents/BookImageForm.vue';

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
    <Head title="Add" />

    <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
        <NavBar />

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden md:rounded-lg">
                <div class="py-2" v-if="content === 1">
                    <BookForm />
                </div>
                <div class="py-6" v-if="content === 2">
                    <AuthorForm />
                </div>
                <div class="py-6" v-if="content === 3">
                    <PublisherForm />
                </div>
                <div class="py-6" v-if="content === 4">
                    <BookAuthorForm :book_id="id"/>
                </div>
                <div class="py-6" v-if="content === 5">
                    <BookImageForm :book_id="id"/>
                </div>
            </div>
        </div>

    </div>
</template>