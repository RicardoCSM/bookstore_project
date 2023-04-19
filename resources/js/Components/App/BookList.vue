<template>
  <div class="container px-4 py-8 mx-auto">
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <div v-for="(book, index) in books" :key="index" class="flex flex-col overflow-hidden bg-white rounded-lg shadow-lg">
        <div class="flex justify-center max-w-full pt-2">
          <BookListImages :book_id="book.id"  class="h-48"/>
        </div>
        <div class="flex-grow px-6 py-4">
          <div class="mb-2 text-xl font-bold">{{ book.name }}</div>
          <p class="mb-2 text-base text-gray-700">US$ {{ book.price }}</p>
        </div>
        <div class="flex flex-col items-center pb-4">
          <a :href="'/books/' + book.id" class="px-6 py-3 text-lg font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">
            View Details
          </a>
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-8">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchBooks" />
    </div>
  </div>
</template>

<script lang="ts">
  import { defineComponent, ref, onMounted, watchEffect } from 'vue'
  import axios from 'axios'
  import IBook from '@/Interfaces/IBook'
  import BookListImages from './BookListImages.vue'
  import Pagination from './Pagination.vue'

  export default defineComponent({
    components: {
      BookListImages,
      Pagination
    },
    setup() {
      const books = ref<IBook[]>([])
      const currentPage = ref<number>(1)
      const lastPage = ref<number>(1)
      const perPage = ref<number>(10)
      const filter = ref<string>('')

      const fetchBooks = (page = 1) => {
        const queryString = window.location.search
        const urlParams = new URLSearchParams(queryString)

        filter.value = urlParams.get('filter') ?? ''
        console.log(filter.value)
        axios
          .get('/api/books', {
            params: {
              filter: 'name:like:%' + filter.value + '%',
              page: page,
              per_page: perPage.value,
            }
          })
          .then(response => {
            books.value = response.data.data
            currentPage.value = response.data.current_page
            lastPage.value = response.data.last_page
          })
          .catch(error => {
            console.log(error)
          })
      }

      onMounted(() => {
        fetchBooks()
      })

      watchEffect(() => {
        fetchBooks()
      })

      return {
        books,
        currentPage,
        lastPage,
        perPage,
        filter,
        fetchBooks,
      }
    }
  })
</script>
