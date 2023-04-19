<template>
  <div class="flex flex-row">
    <div class="w-1/2 p-4">
      <div class="flex justify-center">
        <BookListImages :book_id="book.id" class="w-56" />
      </div>
    </div>
    <div class="w-1/2 p-4">
      <h2 class="mb-2 text-5xl font-semibold text-white">{{ book.name }}</h2>
      <p class="mb-2 text-xl text-gray-300">Publisher: {{ book.publisher.name }}</p>
      <p class="mb-4 text-xl text-gray-300">Price: US$ {{ book.price }}</p>
      <a :href="'/make_order/' + book.id" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        Buy Now
      </a>
      <div class="mt-8">
        <p class="mb-2 text-lg font-medium text-white">Author(s):</p>
        <ul class="pl-4 text-gray-300 list-disc">
          <li v-for="author in book.authors" :key="author.id">{{ author.name }}</li>
        </ul>
        <p class="mt-4 mb-2 text-lg font-medium text-white">ISBN-13: {{ book.isbn_13 }}</p>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import { defineComponent, ref } from 'vue';
  import BookListImages from './BookListImages.vue';
  import axios from 'axios';

  export default defineComponent({
    components: {
      BookListImages,
    },
    props: {
      id: Number,
    },
    setup(props) {
      const book = ref({});

      const fetchBook = () => {
        axios
          .get(`/api/books/${props.id}`)
          .then(response => {
            book.value = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      };

      fetchBook();

      return {
        book,
      };
    },
  });
</script>
