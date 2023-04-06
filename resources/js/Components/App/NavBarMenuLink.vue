<template>
    <a :href="link" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white" exact>{{text}}</a>
</template>

<script lang="ts">

    export default {
        name: "app-navbar-link",
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
    }

</script>