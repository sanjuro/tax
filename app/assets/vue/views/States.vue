<template>
    <div>
        <div class="row col">
            <h1>States</h1>
        </div>

        <div v-if="isLoading" class="row col">
            <p>Loading...</p>
        </div>

        <div v-else-if="hasError" class="row col">
            <div class="alert alert-danger" role="alert">
                {{ error }}
            </div>
        </div>

        <div v-else-if="!hasStates" class="row col">
            No states!
        </div>

          <div v-else class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">
                      State Title
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
                    <th>
                      Average County Total Tax
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="state in states" v-bind:key="state.id">
                      <td>
                        {{state.title}}
                      </td>
                      <td>
                        {{state.shortCode}}
                      </td>
                      <td>
                        {{ formatMoney(state.averageRate) }}
                      </td>
                      <td>
                        {{ formatMoney(state.totalAmount) }}
                      </td>
                      <td>
                        {{ formatMoney(state.averageTotalAmount) }}
                      </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

    </div>
</template>


<script>
    import State from '../components/State';

    export default {
        name: 'states',
        components: {
            State
        },
        data () {
            return {
                message: '',
            };
        },
        created () {
            this.$store.dispatch('state/fetchStates');
        },
        computed: {
            isLoading () {
                return this.$store.getters['state/isLoading'];
            },
            hasError () {
                return this.$store.getters['state/hasError'];
            },
            error () {
                return this.$store.getters['state/error'];
            },
            hasStates () {
                return this.$store.getters['state/hasStates'];
            },
            states () {
                return this.$store.getters['state/states'];
            },
        },
        methods: {
            createState () {
                this.$store.dispatch('state/createState', this.$data.message)
                    .then(() => this.$data.message = '')
            },
            formatMoney(value) {
                let val = (value/1).toFixed(2).replace(',', '.')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        },
    }
</script>