<template>
    <div>
        <div class="row col">
            <h1>Countries</h1>
        </div>

        <div v-if="isLoading" class="row col">
            <p>Loading...</p>
        </div>

        <div v-else-if="hasError" class="row col">
            <div class="alert alert-danger" role="alert">
                {{ error }}
            </div>
        </div>

        <div v-else-if="!hasCountries" class="row col">
            No countries!
        </div>

      <div v-else class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">
                  Country Title
                </th>
                <th>
                  Short Code
                </th>
                <th>
                  Average Tax Rate
                </th>
                <th>
                  Total Tax Collected
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="country in countries" v-bind:key="country.id">
                  <td>
                    {{country.title}}
                  </td>
                  <td>
                    {{country.shortCode}}
                  </td>
                  <td>
                    {{ formatMoney(country.averageRate) }}
                  </td>
                  <td>
                    {{ formatMoney(country.totalAmount) }}
                  </td>
              </tr>

            </tbody>
          </table>
        </div>
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
                message: '',
            };
        },
        created () {
            this.$store.dispatch('country/fetchCountries');
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
        methods: {
            formatMoney(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        },
    }
</script>