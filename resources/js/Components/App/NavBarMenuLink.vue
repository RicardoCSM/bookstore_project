<template>
    <a :href="link" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white" exact>{{text}}</a>
</template>

<script lang="ts">
    import { defineComponent } from 'vue';

    export default defineComponent({
        props: {
            link: {
                type: String,
                required: true
            },
            text: {
                type: String,
                required: true
            },
        },
    })

</script>