<template>
  <div>
    <div class="flex justify-center w-full py-2 space-x-4">
      <a href="/add_book" class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Add new book</a>
      <form class="flex" @submit.prevent="searchBooks">
        <input v-model="searchQuery"
          class="px-3 py-2 text-sm text-white bg-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300"
          type="text" placeholder="Search">
        <button class="px-3 py-2 ml-1 text-white bg-blue-500 rounded-md border-l-white" type="submit"><i
            class="fas fa-search"></i></button>
      </form>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full divide-y divide-gray-300">
        <thead class="bg-gray-800">
          <tr>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Isbn 13</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Pages</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Publication</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Price</th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Add author</span>
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Add image</span>
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Edit</span>
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Delete</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(book, index) in books" :key="index" class="bg-gray-700">
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ book.name }}</td>
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ book.isbn_13 }}</td>
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ book.num_pages }}</td>
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ book.publication_date }}</td>
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ book.price }}</td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <a :href="'/add_book_author/' + book.id" class="text-white hover:text-gray-400">Add author</a>
            </td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <a :href="'/add_image/' + book.id" class="text-white hover:text-gray-400">Add image</a>
            </td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <a :href="'/edit_book/' + book.id" class="text-white hover:text-gray-400">Edit</a>
            </td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <button @click.prevent="deleteBook(book.id)" type="button" class="text-white hover:text-gray-400">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="flex justify-center mt-8 mb-2">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchBooksData" />
    </div>
  </div>

  <Modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watchEffect } from 'vue'
import axios from 'axios'
import { fetchBooks } from '@/Utils/bookApi'
import IBook from '@/Interfaces/IBook'
import Pagination from '@/Components/App/LayoutComponents/Pagination.vue'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
  components: {
    Pagination,
    Modal
  },
  setup() {
    const books = ref<IBook[]>([])
    const currentPage = ref<number>(1)
    const lastPage = ref<number>(1)
    const perPage = ref<number>(12)
    const filter = ref<string>('')
    const searchQuery = ref('')

    const modalTitle = ref('')
    const modalMessage = ref('')
    const showModal = ref(false)

    const searchBooks = () => {
      filter.value = searchQuery.value
      fetchBooksData()
    }

    const fetchBooksData = (page = 1) => {
      fetchBooks(page, perPage.value, filter.value)
        .then(data => {
          books.value = data.data
          currentPage.value = data.current_page
          lastPage.value = data.last_page
        })
        .catch(error => {
          console.log(error)
        })
    }

    const deleteBook = (id) => {
      axios
        .delete(`/api/books/${id}`)
        .then(response => {
          if (response.status === 200) {
            modalTitle.value = 'Success!'
            modalMessage.value = 'Your book has been deleted successfully.'
            showModal.value = true
          } else {
            throw new Error('Error deleting book')
          }
        })
        .catch(error => {
          modalTitle.value = 'Error!'
          modalMessage.value = 'An error occurred while deleting your book.'
          showModal.value = true
        })
    }

    onMounted(() => {
      fetchBooksData()
    })

    watchEffect(() => {
      fetchBooksData()
    })

    return {
      books,
      searchQuery,
      searchBooks,
      currentPage,
      lastPage,
      perPage,
      filter,
      fetchBooksData,
      deleteBook,
      modalTitle,
      modalMessage,
      showModal
    }
  }
})
</script>