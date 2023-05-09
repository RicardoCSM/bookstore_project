<template>
    <div>
        <form @submit.prevent="submitForm"
            class="max-w-md p-8 mx-auto mb-2 bg-white border border-gray-300 rounded-lg shadow-lg">
            <div class="flex justify-center mb-2 align-center">
                <h1 class="text-lg font-bold text-blue-500">Create Publisher</h1>
            </div>
            <div class="mb-2">
                <label for="publisher-name" class="block mb-2 font-bold text-gray-700">Publisher Name</label>
                <input type="text" name="publisher-name" id="publisher-name" v-model="publisherName"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your publisher name"
                    required>
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
import { fetchPublisher } from '@/Utils/publisherApi'
import axios from 'axios'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
    components: {
        Modal
    },
    props: {
        publisher_id: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const publisherName = ref('')

        const modalTitle = ref('')
        const modalMessage = ref('')
        const showModal = ref(false)

        const fetchPublisherData = onMounted(() => {
            fetchPublisher(props.publisher_id)
                .then(publisherData => {
                    publisherName.value = publisherData.name
                })
                .catch(error => {
                    console.log(error)
                })
        })

        const submitForm = () => {

            axios.put(`/api/publishers/${props.publisher_id}`, {
                name: publisherName.value
            })
                .then(response => {
                    if (response.status === 200) {
                        modalTitle.value = 'Success!'
                        modalMessage.value = 'Your publisher has been edited successfully.'
                        showModal.value = true
                    } else {
                        throw new Error('Error editing publisher')
                    }
                })
                .catch(error => {
                    modalTitle.value = 'Error!'
                    modalMessage.value = error.response?.data?.message || 'An error occurred while editing your publisher.'
                    showModal.value = true
                })
        }

        return {
            publisherName,
            submitForm,
            modalTitle,
            modalMessage,
            showModal
        }
    }
});
</script>
    