<template>
    <div class="flex items-center justify-between px-4 py-6 m-5 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="w-1/2 px-6">
            <p class="mb-2 font-bold text-gray-800">{{ order.address.identification }}</p>
            <p class="mb-2 text-gray-700">{{ order.address.street_name }}, {{ order.address.street_number }}</p>
            <p class="mb-2 text-gray-700">{{ order.address.zip_code }}</p>
            <p class="mb-2 text-gray-700">{{ order.address.complement }}</p>
        </div>
        <div class="w-1/2 px-6">
            <p class="mb-2 font-bold text-gray-800">{{ order.book.name }}</p>
            <p class="mb-2 text-gray-700"> U$ {{ order.book.price }}</p>
            <p class="mb-2 text-gray-700">Pages: {{ order.book.num_pages}}</p>
            <ul class="pl-4 mb-2 text-gray-700 list-disc">
              <li v-for="author in order.book.authors" :key="author.id">{{ author.name }}</li>
            </ul>
            <p class="mb-2 text-gray-700">{{ order.book.isnb_13 }}</p>
        </div>
    </div>
</template>
  
<script lang="ts">
    import { defineComponent, ref } from 'vue';
    import axios from 'axios';
  
    export default defineComponent({
      props: {
        id: Number,
      },
      setup(props) {
        const order = ref({});
  
        const fetchOrder = () => {
          axios
            .get(`/api/orders/${props.id}`)
            .then(response => {
              order.value = response.data;
            })
            .catch(error => {
              console.log(error);
            });
        };

        fetchOrder();
  
        return {
            order,
        };
      },
    });
</script>
  