import axios from 'axios';

export const fetchBooks = (page = 1, perPage = 12, filter = '') => {
    return axios.get('/api/books', {
      params: {
        filter: `name:like:%${filter}%`,
        page,
        per_page: perPage,
      },
    }).then(response => response.data)
}

export const fetchBook = (id: number) => {
    return axios.get(`/api/books/${id}`).then(response => response.data)
}