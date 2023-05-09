<template>
  <div class="container px-4 py-8 mx-auto">
    <div v-for="(order, index) in orders" :key="index"
      class="flex items-center justify-between px-4 py-6 m-5 bg-white border border-gray-300 rounded-lg shadow-lg">
      <div class="w-2/4 pr-6">
        <p class="mb-2 font-bold text-gray-800">{{ order.book.name }}</p>
      </div>
      <div class="w-1/4 px-6">
        <p class="mb-2 font-bold text-gray-800">{{ new Date(order.created_at).toLocaleString() }}</p>
      </div>
      <div class="w-1/4 px-6">
        <a :href="'/orders/' + order.id" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
          Order
        </a>
      </div>
    </div>
    <div class="flex justify-center mt-8">
      <Pagination :current-page="currentPage" :last-page="lastPage" @page-changed="fetchOrders" />
    </div>
  </div>
</template>
  
<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import Pagination from '@/Components/App/LayoutComponents/Pagination.vue'
import IOrder from '@/Interfaces/IOrder'

export default defineComponent({
  components: {
    Pagination
  },
  setup() {
    const orders = ref<IOrder[]>([])
    const currentPage = ref<number>(1)
    const lastPage = ref<number>(1)
    const perPage = ref<number>(12)

    const fetchOrders = (page = 1) => {
      axios
        .get('/api/orders', {
          params: {
            page: page,
            per_page: perPage.value,
          }
        })
        .then(response => {
          orders.value = response.data.data
          currentPage.value = response.data.current_page
          lastPage.value = response.data.last_page
        })
        .catch(error => {
          console.log(error)
        })
    }

    onMounted(() => {
      fetchOrders()
    })

    return {
      fetchOrders,
      currentPage,
      lastPage,
      perPage,
      orders,
    }
  }
})
</script>
  