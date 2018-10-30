import axios from 'axios';

export default {
    getCountry (id) {
        return axios.get('/api/countries/${id}');
    },
    getAll () {
        return axios.get('/api/countries');
    },
}