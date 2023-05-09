<template>
  <div>
    <div class="flex justify-center w-full py-2 space-x-4">
      <a href="/add_author" class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Add new
        author</a>
      <form class="flex" @submit.prevent="searchAuthors">
        <input v-model="searchQuery"
          class="px-3 py-2 text-sm text-white bg-gray-700 rounded-md focus:outline-none focus:ring focus:border-blue-300"
          type="text" placeholder="Search">
        <button class="px-3 py-2 ml-1 text-white bg-blue-500 rounded-md border-l-white" type="submit"><i
            class="fas fa-search"></i></button>
      </form>
    </div>
    <div class="overflow-x-auto ">
      <table class="w-full divide-y divide-gray-300">
        <thead class="bg-gray-800">
          <tr>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Name</th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Edit</span>
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Delete</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(author, index) in authors" :key="index" class="bg-gray-700">
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ author.name }}</td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <a :href="'edit_author/' + author.id" class="text-white hover:text-gray-400">Edit</a>
            </td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <button @click.prevent="deleteAuthor(author.id)" type="button" class="text-white hover:text-gray-400">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="flex justify-center mt-8 mb-2">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchAuthorsData" />
    </div>
  </div>

  <Modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watchEffect } from 'vue'
import axios from 'axios'
import { fetchAuthors } from '@/Utils/authorApi'
import Pagination from '@/Components/App/LayoutComponents/Pagination.vue'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
  components: {
    Pagination,
    Modal
  },
  setup() {
    const authors = ref([])
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
      fetchAuthorsData()
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

    const deleteAuthor = (id) => {
      axios
        .delete(`/api/authors/${id}`)
        .then(response => {
          if (response.status === 200) {
            modalTitle.value = 'Success!'
            modalMessage.value = 'Your author has been deleted successfully.'
            showModal.value = true
          } else {
            throw new Error('Error deleting author')
          }
        })
        .catch(error => {
          modalTitle.value = 'Error!'
          modalMessage.value = 'An error occurred while deleting your author.'
          showModal.value = true
        })
    }

    onMounted(() => {
      fetchAuthorsData()
    })

    watchEffect(() => {
      fetchAuthorsData()
    })

    return {
      authors,
      searchQuery,
      searchAuthors,
      currentPage,
      lastPage,
      perPage,
      filter,
      fetchAuthorsData,
      deleteAuthor,
      modalTitle,
      modalMessage,
      showModal
    }
  }
})
</script>