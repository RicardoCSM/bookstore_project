import axios from 'axios';

export const fetchPublishersDropdown = () => {
    return axios.get('/api/publishers').then(response => response.data)
}

export const fetchPublisher = (id: number) => {
    return axios.get(`/api/publishers/${id}`).then(response => response.data)
}