<template>
  <div>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group
        id="input-group-1"
        label="Donor Name:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          v-model="form.donorName"
          placeholder="Enter donorName"
          required
        ></b-form-input>
      </b-form-group>

      
      <b-form-group id="input-group-3" label="Campaingn:" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.campaignID"
          :options="campaigns"
          required
        ></b-form-select>
      </b-form-group>
      
      <b-form-group id="input-group-2" label="amount:" label-for="input-2">
        <b-form-input
          type="number"
          id="input-2"
          v-model="form.amount"
          placeholder="Enter amount"
          required
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card>
  </div>
</template>
  
  <script>
export default {
  data() {
    return {
      form: {
        donorName: "",
        amount: "",
        campaignID: null,
      },
      campaigns: [],
      show: true,
    };
  },
  mounted() {
    this.getCampaigns()
  },
  methods: {
    getCampaigns() {
      this.axios.get('/api/campaigns').then(({data}) => {
        this.campaigns = data.data.map((item) => ({text: item.title, value: item.id}))
      })
    },
    onSubmit(event) {
      event.preventDefault();
      this.axios.post('/api/donations', this.form).then(() => {})
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.email = "";
      this.form.name = "";
      this.form.food = null;
      this.form.checked = [];
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
  },
};
</script>
  