<template>
    <div class="container px-4 py-8 mx-auto">
      <div v-for="(order, index) in orders" :key="index" class="flex items-center justify-between px-4 py-6 m-5 bg-white border border-gray-300 rounded-lg shadow-lg">
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
    </div>
  </template>
  
  <script lang="ts">
    import { defineComponent, ref, onMounted, watchEffect } from 'vue'
    import axios from 'axios'
    import Pagination from './Pagination.vue'
  
    export default defineComponent({
      components: {
        Pagination
      },
      setup() {
        const orders = ref([])
  
        const fetchOrders = (page = 1) => {
          axios
            .get('/api/orders')
            .then(response => {
                console.log(response)
                orders.value = response.data
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
          orders,
        }
      }
    })
  </script>
  