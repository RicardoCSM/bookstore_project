<template>
    <form @submit.prevent="submitForm"
        class="max-w-md p-8 mx-auto mb-2 bg-white border border-gray-300 rounded-lg shadow-lg">
        <div class="flex justify-center mb-2 align-center">
            <h1 class="text-lg font-bold text-blue-500">Add image to Book</h1>
        </div>
        <div class="mb-2">
            <label for="image" class="block mb-2 font-bold text-gray-700">Author Name</label>
            <input type="file" accept="image/png, image/jpeg" name="image" id="image"
                v-on:change="handleFileUpload($event)" class="w-full px-3 py-2 border border-gray-400 rounded" required>
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

    <Modal v-if="showModal" :title="modalTitle" :message="modalMessage" :onClose="() => { showModal = false }" />
</template>
      
<script lang="ts">
import { defineComponent, ref } from 'vue'
import axios from 'axios'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'
import IBook from '@/Interfaces/IBook'

export default defineComponent({
    components: {
        Modal
    },
    props: {
        book_id: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const book = ref<IBook>()
        const image = ref()
        const modalTitle = ref('')
        const modalMessage = ref('')
        const showModal = ref(false)

        const handleFileUpload = (event) => {
            image.value = event.target.files[0];
        }

        const submitForm = () => {
            const formData = new FormData();
            formData.append('book_id', props.book_id.toString());
            formData.append('image', image.value);

            axios.post('/api/book_images', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    console.log(response)
                    if (response.status === 201) {
                        modalTitle.value = 'Success!'
                        modalMessage.value = 'Your image has been added to the book successfully.'
                        showModal.value = true
                    } else {
                        throw new Error('Error adding image')
                    }
                })
                .catch(error => {
                    console.log(error)
                    modalTitle.value = 'Error!'
                    modalMessage.value = error.response?.data?.message || 'An error occurred while adding your image.'
                    showModal.value = true
                })
        }

        return {
            submitForm,
            modalTitle,
            modalMessage,
            showModal,
            book,
            image,
            handleFileUpload
        }
    }
})
</script>
      