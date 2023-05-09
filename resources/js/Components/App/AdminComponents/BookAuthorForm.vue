<template>
  <div class="flex justify-center w-full py-2 space-x-4">
    <h2 class="px-3 py-2 text-lg font-medium text-white rounded-md">{{ book.name }}</h2>
    <form class="flex" @submit.prevent="searchAuthors">
      <input v-model="searchQuery"
        class="px-3 py-2 text-sm text-white bg-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300"
        type="text" placeholder="Search">
      <button class="px-3 py-2 ml-1 text-white bg-blue-500 rounded-md border-l-white" type="submit"><i
          class="fas fa-search"></i></button>
    </form>
  </div>
  <div class="container px-4 py-8 mx-auto">
    <div v-for="(author, index) in authors" :key="index"
      class="flex items-center justify-between px-4 py-6 m-5 bg-white border border-gray-300 rounded-lg shadow-lg">
      <div class="w-1/2 pr-6">
        <p class="mb-2 font-bold text-gray-800">{{ author.name }}</p>
      </div>
      <div class="flex justify-center w-1/2 px-6">
        <button @click.prevent="addBookAuthor(author.id)" type="button"
          class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
          Add
        </button>
      </div>
    </div>
    <div class="flex justify-center mt-8">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchAuthorsData" />
    </div>
  </div>

  <Modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
</template>
    
<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import { fetchBook } from '@/Utils/bookApi'
import { fetchAuthors } from '@/Utils/authorApi'
import Pagination from '@/Components/App/LayoutComponents/Pagination.vue'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'
import IAuthor from '@/Interfaces/IAuthor'
import IBook from '@/Interfaces/IBook'

export default defineComponent({
  components: {
    Pagination,
    Modal
  },
  props: {
    book_id: {
      type: Number,
      required: true
    }
  },
  setup(props) {
    const authors = ref<IAuthor[]>([])
    const book = ref<IBook>()
    const currentPage = ref<number>(1)
    const lastPage = ref<number>(1)
    const perPage = ref<number>(12)
    const filter = ref<string>('')
    const searchQuery = ref('')

    const modalTitle = ref('')
    const modalMessage = ref('')
    const showModal = ref(false)

    const searchAuthors = () => {
      filter.value = searchQuery.value
      fetchAuthors()
    }
    const fetchAuthorsData = (page = 1) => {
      fetchAuthors(page, perPage.value, filter.value)
        .then(data => {
          authors.value = data.data
          currentPage.value = data.current_page
          lastPage.value = data.last_page
        })
        .catch(error => {
          console.log(error)
        })
    }

    const fetchBookData = () => {
      fetchBook(props.book_id)
        .then(bookData => {
          book.value = bookData
        })
        .catch(error => {
          console.log(error)
        })
    }

    const addBookAuthor = (author_id) => {
      axios
        .post('/api/author_books', {
          book_id: props.book_id,
          author_id: author_id
        })
        .then(response => {
          modalTitle.value = 'Success!'
          modalMessage.value = 'Your author has been associated with the book successfully.'
          showModal.value = true
        })
        .catch(error => {
          modalTitle.value = 'Error!'
          modalMessage.value = error.response?.data?.message || 'An error occurred while adding your author.'
          showModal.value = true
        })
    }

    onMounted(() => {
      fetchAuthorsData(),
      fetchBookData()
    })

    return {
      fetchAuthorsData,
      currentPage,
      lastPage,
      perPage,
      authors,
      addBookAuthor,
      modalTitle,
      modalMessage,
      showModal,
      book,
      searchAuthors,
      searchQuery
    }
  }
})
</script>
    