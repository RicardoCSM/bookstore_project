<template>
  <div class="flex items-center justify-center py-6 bg-gray-800 bg-opacity-90">
    <div class="flex flex-col w-full lg:w-3/4 xl:w-2/3 2xl:w-1/2 md:flex-row">
      <div class="flex items-center justify-center w-full md:w-1/2">
        <img src="/img/index_book.png" alt="Book Cover" class="w-1/2 max-w-md rounded-lg">
      </div>
      <div class="flex flex-col items-center justify-center w-full px-4 md:w-1/2 md:items-start">
        <h2 class="mb-4 text-3xl font-bold text-white">Register to Read</h2>
        <p class="mb-4 text-lg text-white">Sign up now to access our library of books!</p>
        <a href="/register" class="px-6 py-2 mb-4 text-lg font-semibold text-white bg-blue-500 rounded-ful md:mr-4">
          Register
        </a>
        <a href="/login" class="text-sm text-gray-600 hover:text-white">Already have an account? Log in</a>
      </div>
    </div>
  </div>
</template>
  
<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({});
</script>
  