<template>
    <div class="flex justify-center">
      <ul class="flex p-0 list-none bg-gray-200 pagination">
        <li v-if="showPrev" @click="changePage(currentPage - 1)" class="px-2 py-1 rounded-md cursor-pointer">
          <i class="fas fa-chevron-left"></i>
        </li>
        <li v-for="page in pages" :key="page" :class="{ 'active': page === currentPage }" @click="changePage(page)" class="px-2 py-1 rounded-md cursor-pointer">
          {{ page }}
        </li>
        <li v-if="showNext" @click="changePage(currentPage + 1)" class="px-2 py-1 rounded-md cursor-pointer hover:">
          <i class="fas fa-chevron-right"></i>
        </li>
      </ul>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent } from 'vue'
  
  export default defineComponent({
    props: {
      currentPage: {
        type: Number,
        required: true,
      },
      lastPage: {
        type: Number,
        required: true,
      },
      edgeLength: {
        type: Number,
        default: 1,
      },
      midLength: {
        type: Number,
        default: 2,
      },
    },
    computed: {
      pages(): (number|string)[] {
        const pages: (number|string)[] = []
        const start = Math.max(1, this.currentPage - this.edgeLength - this.midLength)
        const end = Math.min(this.lastPage, this.currentPage + this.edgeLength + this.midLength)
  
        for (let i = start; i <= end; i++) {
          pages.push(i)
        }
  
        if (start > 1) {
          pages.unshift('...')
          pages.unshift(1)
        }
  
        if (end < this.lastPage) {
          pages.push('...')
          pages.push(this.lastPage)
        }
  
        return pages
      },
      showPrev(): boolean {
        return this.currentPage > 1
      },
      showNext(): boolean {
        return this.currentPage < this.lastPage
      },
    },
    methods: {
      changePage(page: number) {
        if (page >= 1 && page <= this.lastPage) {
          this.$emit('page-changed', page)
        }
      },
    },
  })
  </script>
  
<style scoped>
  .pagination li {
    margin: 0 5px;
    cursor: pointer;
  }
  
  .pagination li.active {
    font-weight: bold;
  }
  
  .pagination i {
    font-size: 0.8rem;
  }
</style>
  