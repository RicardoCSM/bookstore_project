<template>
  <div>
    <div class="flex justify-center w-full py-2 space-x-4">
      <a href="/add_publisher" class="px-3 py-2 text-lg font-medium text-gray-300 rounded-md hover:text-white">Add new
        publisher</a>
      <form class="flex" @submit.prevent="searchPublishers">
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

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Edit</span>
            </th>

            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
              <span class="sr-only">Delete</span>
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(publisher, index) in publishers" :key="index" class="bg-gray-700">
            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">{{ publisher.name }}</td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <a :href="'edit_publisher/' + publisher.id" class="text-white hover:text-gray-400">Edit</a>
            </td>

            <td class="px-3 py-4 text-sm text-white whitespace-nowrap">
              <button @click.prevent="deletePublisher(publisher.id)" type="button" class="text-white hover:text-gray-400">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="flex justify-center mt-8 mb-2">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchPublishers" />
    </div>
  </div>

  <Modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watchEffect } from 'vue'
import axios from 'axios'
import Pagination from '@/Components/App/LayoutComponents/Pagination.vue'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
  components: {
    Pagination,
    Modal
  },
  setup() {
    const publishers = ref([])
    const currentPage = ref<number>(1)
    const lastPage = ref<number>(1)
    const perPage = ref<number>(12)
    const filter = ref<string>('')
    const searchQuery = ref('')

    const modalTitle = ref('')
    const modalMessage = ref('')
    const showModal = ref(false)

    const searchPublishers = () => {
      filter.value = searchQuery.value
      fetchPublishers()
    }
    
    const fetchPublishers = (page = 1) => {
      axios
        .get('/api/publishers', {
          params: {
            filter: 'name:like:%' + filter.value + '%',
            page: page,
            per_page: perPage.value,
          }
        })
        .then(response => {
          publishers.value = response.data.data
          currentPage.value = response.data.current_page
          lastPage.value = response.data.last_page
        })
        .catch(error => {
          console.log(error)
        })
    }

    const deletePublisher = (id) => {
      axios
        .delete(`/api/publishers/${id}`)
        .then(response => {
          if (response.status === 200) {
            modalTitle.value = 'Success!'
            modalMessage.value = 'Your publisher has been deleted successfully.'
            showModal.value = true
          } else {
            throw new Error('Error deleting publisher')
          }
        })
        .catch(error => {
          modalTitle.value = 'Error!'
          modalMessage.value = 'An error occurred while deleting your publisher.'
          showModal.value = true
        })
    }

    onMounted(() => {
      fetchPublishers()
    })

    watchEffect(() => {
      fetchPublishers()
    })

    return {
      publishers,
      searchQuery,
      searchPublishers,
      currentPage,
      lastPage,
      perPage,
      filter,
      fetchPublishers,
      deletePublisher,
      modalTitle,
      modalMessage,
      showModal
    }
  }
})
</script>