<template>
  <div>
    <div class="flex">
      <h2>Donations</h2>
      <div>
        <v-button >
          <b-link to="/donations/create">Create donation</b-link>
        </v-button>
      </div>
    </div>
    <b-table :busy="isBusy" small hover :items="items" :fields="fields" responsive="sm">
      <template #table-busy>
        <div class="text-center text-danger my-2">
          <b-spinner class="align-middle"></b-spinner>
          <strong>Loading...</strong>
        </div>
      </template>

      <template #cell(name)="data">
        <b class="text-info">{{ data.value.last.toUpperCase() }}</b>, <b>{{ data.value.first }}</b>
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
    name: 'Donations',
    data() {
        return {
          isBusy: false,
          fields: [ 'donorName', 'campaignID', 'amount'],
          items: []
        }
    },
    mounted() {
      console.log('profiles');
      this.getProfiles()
    },
    methods: {
      getProfiles() {
        this.isBusy = true
        this.axios.get('/api/donations')
          .then(({data}) => {    
              this.items = data.data
          })
          .finally(() => this.isBusy = false)
      }
    }
}
</script>

<style>

</style>