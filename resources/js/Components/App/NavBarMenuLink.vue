<template>
    <router-link to="link" class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white" exact>{{text}}</router-link>
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

<style scoped>
  .router-link-active {
    color: #fff;
  }
</style>