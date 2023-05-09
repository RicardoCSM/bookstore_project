<template>
    <div>
        <form @submit.prevent="submitForm"
            class="max-w-md p-8 mx-auto mb-2 bg-white border border-gray-300 rounded-lg shadow-lg">
            <div class="flex justify-center mb-2 align-center">
                <h1 class="text-lg font-bold text-blue-500">Create author</h1>
            </div>
            <div class="mb-2">
                <label for="author-name" class="block mb-2 font-bold text-gray-700">Author Name</label>
                <input type="text" name="author-name" id="author-name" v-model="authorName"
                    class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your author name" required>
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
import { fetchAuthor } from '@/Utils/authorApi'
import Modal from '@/Components/App/LayoutComponents/Modal.vue'

export default defineComponent({
    components: {
        Modal
    },
    props: {
        author_id: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const authorName = ref('')

        const modalTitle = ref('')
        const modalMessage = ref('')
        const showModal = ref(false)


        const fetchAuthorData = onMounted(() => {
            fetchAuthor(props.author_id)
                .then(authorData => {
                    authorName.value = authorData.name
                })
                .catch(error => {
                    console.log(error)
                })
        })

        const submitForm = () => {

            axios.put(`/api/authors/${props.author_id}`, {
                name: authorName.value
            })
                .then(response => {
                    if (response.status === 200) {
                        modalTitle.value = 'Success!'
                        modalMessage.value = 'Your author has been edited successfully.'
                        showModal.value = true
                    } else {
                        throw new Error('Error editing author')
                    }
                })
                .catch(error => {
                    modalTitle.value = 'Error!'
                    modalMessage.value = error.response?.data?.message || 'An error occurred while editing your author.'
                    showModal.value = true
                })
        }

        return {
            authorName,
            submitForm,
            modalTitle,
            modalMessage,
            showModal
        }
    }
});
</script>
    