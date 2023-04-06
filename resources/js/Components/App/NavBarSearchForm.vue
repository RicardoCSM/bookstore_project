<template>
    <form class="flex" @submit.prevent="searchBooks">
        <input v-model="searchQuery" class="px-3 py-2 text-sm text-white bg-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300" type="text" placeholder="Search">
        <button class="px-3 py-2 ml-1 text-white bg-blue-500 rounded-md border-l-white" type="submit"><i class="fas fa-search"></i></button>
      </form>
</template>

<script lang="ts">

    export default {
        data() {
            return {
                searchQuery: ''
            }
        },
        methods: {
            searchBooks() {
                if (!this.searchQuery) {
                    return
                }

                this.$inertia.visit(`/books?filter=${this.searchQuery}`);
            }
        }
    }
</script>