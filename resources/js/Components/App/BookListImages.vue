<template>
    <img :src="bookImageSrc">
</template>

<script lang="ts">
    import { defineComponent, ref, onMounted } from 'vue'
    import axios from 'axios'
    import IBookImages from '@/Interfaces/IBookImages'

    export default defineComponent({
        props: {
            book_id: {
                type: Number,
                required: true
            }
        },
        setup(props) {
            const bookImages = ref<IBookImages[]>([]);
            const bookImageSrc = ref<string>('');

            onMounted(() => {
                axios
                    .get('/api/book_images')
                    .then(response => {
                        bookImages.value = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });

            const getBookImage = (bookId: number) => {
                const bookImage = bookImages.value.find(image => image.book_id === bookId);
                const imagePath = bookImage && bookImage.image ? `/storage/${bookImage.image}` : 'https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg';
                return imagePath;
            };

            bookImageSrc.value = getBookImage(props.book_id);

            return {
                bookImageSrc
            };
        }
    })
</script>