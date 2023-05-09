<template>
    <div>
        <form @submit.prevent="submitForm"
            class="max-w-md p-8 mx-auto mb-2 bg-white border border-gray-300 rounded-lg shadow-lg">
            <div class="flex justify-center mb-2 align-center">
                <h1 class="text-lg font-bold text-blue-500">Create book</h1>
            </div>
            <div class="mb-2">
                <label for="book-name" class="block mb-2 font-bold text-gray-700">Book Name</label>
                <input type="text" name="book-name" id="book-name" v-model="book.name"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your book name" required>
            </div>
            <div class="mb-2">
                <label for="num-pages" class="block mb-2 font-bold text-gray-700">Pages</label>
                <input type="number" name="num-pages" id="num-pages" v-model="book.num_pages"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter the number of pages"
                    required>
            </div>
            <div class="mb-2">
                <label for="isbn_13" class="block mb-2 font-bold text-gray-700">Isbn 13</label>
                <input type="text" name="isbn_13" id="isbn_13" v-model="book.isbn_13"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter the ISBN 13" required>
            </div>
            <div class="mb-2">
                <label for="publication_date" class="block mb-2 font-bold text-gray-700">Publication date</label>
                <input type="date" name="publication_date" id="publication_date" v-model="book.publication_date"
                    class="w-full px-3 py-2 border border-gray-400 rounded" required>
            </div>
            <div class="mb-2">
                <label for="price" class="block mb-2 font-bold text-gray-700">Price</label>
                <input type="text" name="price" id="price" v-model="book.price"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter the price (Ex: 99.99)"
                    required>
            </div>
            <div class="mb-2">
                <label for="publishers" class="block mb-2 font-bold text-gray-700">Select a publisher:</label>
                <select class="w-full px-3 py-2 border border-gray-400 rounded" name="publishers" id="publishers"
                    v-model="book.publisher_id" required>
                    <option v-for="(publisher, index) in publishers" :key="index" :value="publisher.id">{{ publisher.name }}
                    </option>
                </select>
            </div>
            <div class="flex justify-center">
                <a href="/dashboard" class="px-4 py-2 mr-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Back
                </a>
                <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>

        <modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
    </div>
</template>
    
<script lang="ts">
import { defineComponent, onMounted, ref } from 'vue'
import axios from 'axios'
import { fetchPublishersDropdown } from '@/Utils/publisherApi'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
    components: {
        Modal
    },
    setup() {
        const book = {
            name: '',
            num_pages: 0,
            isbn_13: '',
            publication_date: '',
            price: '',
            publisher_id: 0
        }

        const publishers = ref([])

        const modalTitle = ref('')
        const modalMessage = ref('')
        const showModal = ref(false)

        const fetchPublishersData = onMounted(() => {
            fetchPublishersDropdown()
                .then(data => {
                    publishers.value = data.data
                })
                .catch(error => {
                    console.log(error)
                })
        })

        const submitForm = () => {

            axios.post('/api/books', book)
                .then(response => {
                    if (response.status === 201) {
                        book.name = ''
                        book.num_pages = 0
                        book.isbn_13 = ''
                        book.publication_date = ''
                        book.price = ''
                        book.publisher_id = 0

                        modalTitle.value = 'Success!'
                        modalMessage.value = 'Your book has been created successfully.'
                        showModal.value = true
                    } else {
                        throw new Error('Error creating book')
                    }
                })
                .catch(error => {
                    modalTitle.value = 'Error!'
                    modalMessage.value = error.response?.data?.message || 'An error occurred while creating your book.'
                    showModal.value = true
                })
        }

        return {
            book,
            publishers,
            submitForm,
            modalTitle,
            modalMessage,
            showModal
        }
    }
});
</script>