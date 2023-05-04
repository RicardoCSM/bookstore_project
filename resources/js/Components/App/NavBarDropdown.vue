<template>
    <div class="relative z-20 inline-block text-right sm:ml-1">
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" @click="isOpen = !isOpen" class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center" type="button">
            {{ buttonLabel }}
            <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    
        <div v-show="isOpen" id="dropdown" class="absolute right-0 z-10 mt-2 bg-gray-700 divide-y divide-gray-100 rounded-lg shadow w-44" role="menu" aria-labelledby="dropdownDefaultButton">
            <ul class="py-2 text-sm text-gray-200">
            <li v-if="admin === 1">
                <a href="/dashboard" class="block px-4 py-2 hover:bg-gray-600 hover:text-white" role="menuitem">Dashboard</a>
            </li>
            <li>
                <a href="/profile" class="block px-4 py-2 hover:bg-gray-600 hover:text-white" role="menuitem">Profile</a>
            </li>
            <li>
                <a href="/orders" class="block px-4 py-2 hover:bg-gray-600 hover:text-white" role="menuitem">My Orders</a>
            </li>
            <li>
                <button type="button" @click.prevent="logOut()" class="block w-full px-4 py-2 text-right hover:bg-gray-600 hover:text-white" role="menuitem">Sign out</button>
            </li>
            </ul>
        </div>
    </div>
</template>
  
<script lang="ts">

  import axios from 'axios';
  import {defineComponent, ref, onMounted} from 'vue'
  import { usePage } from '@inertiajs/vue3'

  export default defineComponent({
    props: {
      buttonLabel: {
        type: String,
        default: "Options",
      },
    },
    setup() {
      const page = usePage()
      const admin = ref(0)
      const isOpen = ref<boolean>(false)

      onMounted(() => {
        checkRole()
      })

      const checkRole = () => {
        if(page.props.auth.user && page.props.auth.user.admin !== 0) {
          admin.value = 1
        }
      }

      const logOut = () => {
        axios
          .post('/logout')
          .catch(error => {
            console.log(error)
          })

          window.location.reload()
      }

      return {
        isOpen,
        logOut,
        admin
      };
    }
  });
</script>
  