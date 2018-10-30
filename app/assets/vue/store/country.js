import CountryAPI from '../api/country';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        countries: [],
    },
    getters: {
        isLoading (state) {
            return state.isLoading;
        },
        hasError (state) {
            return state.error !== null;
        },
        error (state) {
            return state.error;
        },
        hasCountries (state) {
            return state.countries.length > 0;
        },
        countries (state) {
            return state.countries;
        },
    },
    mutations: {
        ['FETCHING_COUNTRY'](state) {
            state.isLoading = true;
            state.error = null;
            state.countries = [];
        },
        ['FETCHING_COUNTRY_SUCCESS'](state, country) {
            state.isLoading = true;
            state.error = null;
            state.countries.unshift(country);
        },
        ['FETCHING_COUNTRY_ERROR'](state, error) {
            state.isLoading = true;
            state.error = null;
            state.countries = [];
        },
        ['FETCHING_COUNTRIES'](state) {
            state.isLoading = true;
            state.error = null;
            state.countries = [];
        },
        ['FETCHING_COUNTRIES_SUCCESS'](state, countries) {
            state.isLoading = false;
            state.error = null;
            state.countries = countries;
        },
        ['FETCHING_COUNTRIES_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.countries = [];
        },
    },
    actions: {
        fetchCountry ({commit}) {
            commit('FETCHING_COUNTRY');
            return CountryAPI.getCountry(id)
                .then(res => commit('FETCHING_COUNTRIES_SUCCESS', res.data))
                .catch(err => commit('FETCHING_COUNTRIES_ERROR', err));
        },
        fetchCountries ({commit}) {
            commit('FETCHING_COUNTRIES');
            return CountryAPI.getAll()
                .then(res => commit('FETCHING_COUNTRIES_SUCCESS', res.data))
                .catch(err => commit('FETCHING_COUNTRIES_ERROR', err));
        },
    },
}