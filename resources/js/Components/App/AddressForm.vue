<template>
  <div>
    <form @submit.prevent="submitForm" class="max-w-md p-8 mx-auto mb-2 bg-white border border-gray-300 rounded-lg shadow-lg">
      <div class="flex justify-center mb-2 align-center">
          <h1 class="text-lg font-bold text-blue-500">Create Address</h1>
      </div>
      <div class="mb-2">
        <label for="address-identification" class="block mb-2 font-bold text-gray-700">Address Identification</label>
        <input type="text" name="address-identification" id="address-identification" v-model="addressIdentification" class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your address identification" required>
      </div>
      <div class="mb-2">
        <label for="street-name" class="block mb-2 font-bold text-gray-700">Street Name</label>
        <input type="text" name="street-name" id="street-name" v-model="streetName" class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your street name" required>
      </div>
      <div class="mb-2">
        <label for="street-number" class="block mb-2 font-bold text-gray-700">Street Number</label>
        <input type="text" name="street-number" id="street-number" v-model="streetNumber" class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your street number" required>
      </div>
      <div class="mb-2">
        <label for="zip-code" class="block mb-2 font-bold text-gray-700">Zip Code</label>
        <input type="text" name="zip-code" id="zip-code" v-model="zipCode" class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter your zip code" required>
      </div>
      <div class="mb-2">
        <label for="complement" class="block mb-2 font-bold text-gray-700">Complement</label>
        <input type="text" name="complement" id="complement" v-model="complement" class="w-full px-3 py-2 border border-gray-400 rounded" placeholder="Enter any additional information">
      </div>
      <div class="flex justify-center">
        <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
          Submit
        </button>
      </div>
    </form>

    <modal
      v-if="showModal"
      :title="modalTitle"
      :message="modalMessage"
      :onClose="() => { showModal = false }"
    />
  </div>

</template>
  
<script lang="ts">
  import { defineComponent, ref} from 'vue'
  import axios from 'axios'
  import { usePage } from '@inertiajs/vue3'
  import Modal from './Modal.vue'

  export default defineComponent({
    components: {
      Modal
    },
    setup() {
        const addressIdentification = ref('')
        const streetName = ref('')
        const streetNumber = ref('')
        const zipCode = ref('')
        const complement = ref('')
        const page = usePage()

        const modalTitle = ref('')
        const modalMessage = ref('')

        const showModal = ref(false)

        const submitForm = () => {

          axios.post('/api/addresses', {
            user_id: page.props.auth.user.id,
            identification: addressIdentification.value,
            street_name: streetName.value,
            street_number: streetNumber.value,
            zip_code: zipCode.value,
            complement: complement.value
          })
          .then(response => {
            if(response.status === 201) {
              addressIdentification.value = ''
              streetName.value = ''
              streetNumber.value = ''
              zipCode.value = ''
              complement.value = ''
            
              modalTitle.value = 'Success!'
              modalMessage.value = 'Your address has been created successfully.'
              showModal.value = true
            } else {
              throw new Error('Error creating address')
            }
          })
          .catch(error => {
            modalTitle.value = 'Error!'
            modalMessage.value = 'An error occurred while creating your address.'
            showModal.value = true
          })
        }

        return {
          addressIdentification,
          streetName,
          streetNumber,
          zipCode,
          complement,
          submitForm,
          modalTitle,
          modalMessage,
          showModal
        }
    }
  });
</script>
  