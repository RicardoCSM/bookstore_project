<template>
    <form class="flex" @submit.prevent="searchBooks">
        <input v-model="searchQuery" class="px-3 py-2 text-sm text-white bg-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300" type="text" placeholder="Search">
        <button class="px-3 py-2 ml-1 text-white bg-blue-500 rounded-md border-l-white" type="submit"><i class="fas fa-search"></i></button>
    </form>
</template>

<script lang="ts">
    import { computed, defineComponent, ref } from 'vue';
    import { InertiaLinkProps } from '@inertiajs/vue3'

    export default defineComponent({
        setup() {
            const searchQuery = ref('')

            const searchBooks = () => {
                if (!searchQuery.value) {
                    return
                }

                window.location.href = `/books?filter=${searchQuery.value}`;
            }

            return {
                searchQuery,
                searchBooks
            }
        },
    })
</script>