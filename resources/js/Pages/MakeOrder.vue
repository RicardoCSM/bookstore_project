<script setup lang="ts">
import NavBar from '@/Components/App/NavBar.vue';
import Footer from '@/Components/App/Footer.vue';
import AddressForm from '@/Components/App/AddressForm.vue';
import ConfirmOrderButton from '@/Components/App/ConfirmOrderButton.vue';

import { Head } from '@inertiajs/vue3';
import { ref, onMounted, computed} from 'vue';
import IBook from '@/Interfaces/IBook';
import axios from 'axios';

const content = ref(1)
const addresses= ref([])
const selectedAddress = ref(null)
const book = ref<IBook[]>([])

const props = defineProps({
  id: {
    type: String,
    required: true
  }
});

onMounted(() => {
    const id = props.id;
    axios.get(`/api/books/${id}`)
        .then(response => {
            book.value = response.data;
        })
        .catch(error => {
        console.log(error);
        });

    axios.get('/api/addresses')
        .then(response => {
            addresses.value = response.data;
        })
        .catch(error => {
            console.log(error);
        });
})

const changeContent = () => {
    if(content.value === 1) {
        content.value = 2
    } else {
        content.value = 1
    }
}

const footerClass = computed(() => {
    return content.value === 1 ? 'fixed bottom-0 left-0 z-20 w-full' : 'relative';
});

const selectedAddressInfo = computed(() => {
  if (!selectedAddress.value) {
    return null;
  }
  const address = addresses.value.find((a) => a.id === selectedAddress.value.id);
  return address ? `${address.identification}, ${address.street_name}, ${address.street_number}, ${address.zip_code}, ${address.complement}` : null;
});

</script>

<template>
    <Head title="Make Order" />

    <div
        class="relative min-h-screen bg-gray-900 selection:bg-blue-500 selection:text-white"
    >
        <NavBar/>

        <div class="py-6">
            
            <div v-if="content === 1">
                <div class="flex items-center justify-between px-4 py-6 m-5 bg-white border border-gray-300 rounded-lg shadow-lg">
                  <div class="w-1/2 pr-6">
                    <select v-model="selectedAddress" class="block w-full px-4 py-2 leading-tight text-gray-700 bg-white border border-gray-400 rounded-lg appearance-none focus:outline-none focus:border-gray-500">
                      <option value="">Select an address</option>
                      <option v-for="address in addresses" :value="address">{{ address.identification }}</option>
                    </select>
                    <button type="button" @click.prevent="changeContent()" class="inline-block px-4 py-2 mt-4 font-bold text-white bg-indigo-500 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline-indigo">
                      Add address
                    </button>
                  </div>
                  <div v-if="selectedAddress" class="w-1/3 px-6">
                    <p class="mb-2 font-bold text-gray-800">{{ selectedAddress.identification }}</p>
                    <p class="mb-2 text-gray-700">{{ selectedAddress.street_name }}, {{ selectedAddress.street_number }}</p>
                    <p class="mb-2 text-gray-700">{{ selectedAddress.zip_code }}</p>
                    <p class="mb-2 text-gray-700">{{ selectedAddress.complement }}</p>
                  </div>
                  <div class="w-1/3 px-6">
                    <p class="mb-2 font-bold text-gray-800">{{ book.name }}</p>
                    <p class="mb-2 text-gray-700">{{ book.publisher.name}}, U$ {{ book.price }}</p>
                    <p class="mb-2 text-gray-700">Pages: {{ book.num_pages}}</p>
                    <ul class="pl-4 mb-2 text-gray-700 list-disc">
                      <li v-for="author in book.authors" :key="author.id">{{ author.name }}</li>
                    </ul>
                    <p class="mb-2 text-gray-700">{{ book.isnb_13 }}</p>
                  </div>
                </div>
                <div v-if="selectedAddress" class="flex justify-center">
                    <ConfirmOrderButton :book_id="book.id" :address_id="selectedAddress.id"/>
                </div>
            </div>

            <div v-if="content === 2">
                <AddressForm/>
                <div class="flex justify-center">
                    <button type="button" @click.prevent="changeContent()" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        Continue order
                    </button>
                </div>
            </div>
        </div>
                    
        <Footer :class="footerClass"/>
    </div>

</template>