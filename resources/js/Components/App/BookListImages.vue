<template>
    <img :src="getBookImage(book_id)">
</template>

<script lang="ts">
    import axios from 'axios'
    import IBookImages from '@/Interfaces/IBookImages'

    export default {
        props: {
            book_id: {
                type: Number,
                required: true
            }
        },
        data(): { bookImages: IBookImages[] } {
            return {
            bookImages: []
            }
        },
        mounted() {
            axios
            .get('/api/book_images')
            .then(response => {
                this.bookImages = response.data.data
            })
            .catch(error => {
                console.log(error)
            })
        },
        methods: {
            getBookImage(bookId: number) {
                const bookImage = this.bookImages.find(image => image.book_id === bookId);
                const imagePath = bookImage && bookImage.image ? `/storage/${bookImage.image}` : 'https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg';
                return imagePath;
            }
        }
    }
</script>