import StateAPI from '../api/state';

export default {
    namespaced: true,
    state: {
        isLoading: false,
        error: null,
        states: [],
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
        hasStates (state) {
            return state.states.length > 0;
        },
        states (state) {
            return state.states;
        },
    },
    mutations: {
        ['FETCHING_STATES'](state) {
            state.isLoading = true;
            state.error = null;
            state.states = [];
        },
        ['FETCHING_STATES_SUCCESS'](state, states) {
            state.isLoading = false;
            state.error = null;
            state.states = states;
        },
        ['FETCHING_STATES_ERROR'](state, error) {
            state.isLoading = false;
            state.error = error;
            state.states = [];
        },
    },
    actions: {
        fetchStates ({commit}) {
            commit('FETCHING_STATES');
            return StateAPI.getAll()
                .then(res => commit('FETCHING_STATES_SUCCESS', res.data))
                .catch(err => commit('FETCHING_STATES_ERROR', err));
        },
    },
}