<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 text-xs font-semibold tracking-widest text-gray-800 uppercase transition duration-150 ease-in-out bg-white border border-transparent rounded-md py-2bg-gray-200 hover:bg-white focus:bg-white active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-gray-800"
    >
        <slot />
    </button>
</template>
