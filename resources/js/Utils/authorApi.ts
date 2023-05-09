import axios from 'axios';

export const fetchAuthors = (page = 1, perPage = 12, filter = '') => {
    return axios.get('/api/authors', {
      params: {
        filter: `name:like:%${filter}%`,
        page,
        per_page: perPage,
      },
    }).then(response => response.data)
}

export const fetchAuthor = (id: number) => {
    return axios.get(`/api/authors/${id}`).then(response => response.data)
}