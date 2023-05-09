<template>
  <div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="max-w-sm my-8 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl">
            <div class="px-6 py-4 bg-gray-100">
                <div class="flex items-center justify-between pb-3">
                    <h3 class="text-lg font-semibold text-gray-800">{{ title }}</h3>
                    <button @click="close" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-700">{{ message }}</p>
            </div>
            <div class="flex justify-end px-4 py-3 bg-gray-50">
                <button @click="close"
                    class="px-4 py-2 text-white transition-colors duration-300 bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700">
                    OK
                </button>
            </div>
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