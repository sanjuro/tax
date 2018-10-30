import Vue from 'vue';
import Vuex from 'vuex';
import CountryModule from './country';
import SecurityModule from './security';
import StateModule from './state';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
    	country: CountryModule,
        security: SecurityModule,
        state: StateModule,
    },
});