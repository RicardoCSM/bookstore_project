<template>
  <div class="flex justify-center">
    <ul class="flex p-0 list-none bg-gray-200 rounded-md pagination">
      <li v-if="showPrev" @click="changePage(currentPage - 1)" class="px-2 py-1 rounded-md cursor-pointer">
        <i class="fas fa-chevron-left"></i>
      </li>
      <li v-for="page in pages" :key="page" :class="{ 'active': page === currentPage }" @click="changePage(page)"
        class="px-2 py-1 rounded-md cursor-pointer">
        {{ page }}
      </li>
      <li v-if="showNext" @click="changePage(currentPage + 1)" class="px-2 py-1 rounded-md cursor-pointer hover:">
        <i class="fas fa-chevron-right"></i>
      </li>
    </ul>
  </div>
</template>
  
<script lang="ts">
import { defineComponent, computed, Ref } from 'vue'

interface PaginationProps {
  currentPage: number
  lastPage: number
  edgeLength: number
  midLength: number
}

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
  setup(props: PaginationProps, { emit }): { pages: Ref<number[]>, showPrev: Ref<boolean>, showNext: Ref<boolean>, changePage: (page: number) => void } {
    const pages = computed(() => {
      const pageArray: number[] = []
      const start = Math.max(1, props.currentPage - props.edgeLength - props.midLength)
      const end = Math.min(props.lastPage, props.currentPage + props.edgeLength + props.midLength)

      for (let i = start; i <= end; i++) {
        pageArray.push(i)
      }

      if (start > 1) {
        pageArray.unshift(1)
      }

      if (end < props.lastPage) {
        pageArray.push(props.lastPage)
      }

      return pageArray
    })

    const showPrev = computed(() => props.currentPage > 1)
    const showNext = computed(() => props.currentPage < props.lastPage)

    function changePage(page: number) {
      if (page >= 1 && page <= props.lastPage) {
        emit('page-changed', page)
      }
    }

    return { pages, showPrev, showNext, changePage }
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
  