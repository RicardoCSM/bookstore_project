<script setup lang="ts">
import NavBar from '@/Components/App/LayoutComponents/NavBar.vue';

import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import BooksTable from '@/Components/App/AdminComponents/BooksTable.vue';
import AuthorsTable from '@/Components/App/AdminComponents/AuthorsTable.vue';
import PublishersTable from '@/Components/App/AdminComponents/PublishersTable.vue';

const content = ref(0)

</script>

<template>
    <Head title="Book" />

    <div class="relative min-h-screen bg-gray-900 bg-center selection:bg-blue-500 selection:text-white">
        <NavBar />

        <div class="flex justify-center w-full py-2 space-x-4">
            <button type="button" @click.prevent="content = 1"
                class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Books</button>
            <button type="button" @click.prevent="content = 2"
                class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Authors</button>
            <button type="button" @click.prevent="content = 3"
                class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Publishers</button>
        </div>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden md:rounded-lg">
                <div v-if="content === 1">
                    <BooksTable />
                </div>
                <div v-if="content === 2">
                    <AuthorsTable />
                </div>
                <div v-if="content === 3">
                    <PublishersTable />
                </div>
            </div>
        </div>

    </div>
</template>