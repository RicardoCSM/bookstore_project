<template>
    <div class="flex flex-col items-center justify-center bg-center bg-cover h-96 banner-image">
      <div class="block text-5xl font-bold tracking-wider text-white uppercase">
        <h1 class="drop-shadow-[0_1.2px_1.2px_rgba(0,0,0,0.8)]">The Night Owl</h1>
      </div>
      <div class="mt-8">
        <a href="/books" class="block px-6 py-2 font-semibold text-gray-900 bg-white border-2 border-black rounded-full hover:bg-gray-300">
          Browse Books
        </a>
      </div>
    </div>      
</template>
  
  
<script lang="ts">
  import { defineComponent} from 'vue'

  export default defineComponent({});
</script>
  
<style scoped>
    .banner-image {
        background-image: url("/img/index_banner.jpg");
    }
</style>