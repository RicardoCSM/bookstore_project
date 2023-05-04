<template>
    <div class="fixed inset-0 z-50 flex items-center justify-center">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      <div class="relative bg-white rounded-lg w-80">
        <div class="px-6 py-4">
          <div class="flex items-center justify-between pb-3">
            <p class="text-lg font-semibold">{{ title }}</p>
            <button @click="close" class="text-gray-500 hover:text-gray-700 focus:outline-none">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Close</title>
                <path d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 7.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 9l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 7.586l1.52-1.52z"/>
              </svg>
            </button>
          </div>
          <p class="text-sm text-gray-700">{{ message }}</p>
        </div>
        <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
          <button @click="close" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
            OK
          </button>
        </div>
      </div>
    </div>
</template>
  
<script lang="ts">
  export default {
    props: {
      title: {
        type: String,
        required: true
      },
      message: {
        type: String,
        required: true
      },
      onClose: {
        type: Function,
        required: true
      }
    },
    methods: {
      close() {
        this.onClose();
      }
    }
  };
</script>