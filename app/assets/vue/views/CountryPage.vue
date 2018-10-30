<template>
  <div class="single-product">
  	<div v-if="loaded">
	   	<h3>Country details</h3>
	   	<div class="card">
	      <div class="card-header">
	        header
	      </div>
	      <div class="card-body">
	        <p >Country Name: {{title}}</p>
	        <p >Country Short Code: {{shortCode}}</p>
	      </div>
		</div>
    </div>
    <div v-else> 
    	<h3>Loading...</h3>
    </div>
  </div>
</template>

<script>
    import Country from '../components/Country';

    export default {
        name: 'countries',
        components: {
            Country
        },
        data () {
            return {
                title: '',
            };
        },
        created () {
            this.$store.dispatch('country/fetchCountry', this.$data.id)
                    .then(() => this.$data.id = '')
        },
        computed: {
            isLoading () {
                return this.$store.getters['country/isLoading'];
            },
            hasError () {
                return this.$store.getters['country/hasError'];
            },
            error () {
                return this.$store.getters['country/error'];
            },
            hasCountries () {
                return this.$store.getters['country/hasCountries'];
            },
            countries () {
                return this.$store.getters['country/countries'];
            },
        },
    }
</script>