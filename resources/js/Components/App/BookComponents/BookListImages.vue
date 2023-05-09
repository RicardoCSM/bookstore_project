<template>
  <img :src="getBookImage(book_id)">
</template>

<script lang="ts">
  import axios from 'axios'
  import {defineComponent, ref, onMounted} from 'vue'
  import IBookImages from '@/Interfaces/IBookImages'

  export default defineComponent({
      props: {
          book_id: {
              type: Number,
              required: true
          }
      },
      setup() {
        const bookImages = ref<IBookImages[]>([])

        onMounted(() => {
          axios
          .get('/api/book_images')
          .then(response => {
              bookImages.value = response.data.data
          })
          .catch(error => {
              console.log(error)
          })
        })

        const getBookImage = (bookId) => {
              const bookImage = (bookImages.value as any).find(image => image.book_id === bookId);
              const imagePath = bookImage && bookImage.image ? `/storage/${bookImage.image}` : 'https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg';
              return imagePath;
        }

        return {
          getBookImage
        }
      }
  })
</script>