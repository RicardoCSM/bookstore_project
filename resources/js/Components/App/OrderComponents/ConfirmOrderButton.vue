<template>
  <button type="button" @click.prevent="confirmOrder()"
    class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
    Confirm order
  </button>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3'
import IAuth from '@/Interfaces/IAuth';

export default defineComponent({
  props: {
    book_id: Number,
    address_id: Number,
  },
  setup(props) {
    const page = usePage();
    const auth = page.props.auth as IAuth

    const confirmOrder = () => {
      axios
        .post('/api/orders', {
          user_id: auth.user.id,
          book_id: props.book_id,
          address_id: props.address_id,
        })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          console.log(error);
        });

      window.location.href = "http://localhost/orders"
    };

    return {
      confirmOrder,
    };
  },
});
</script>