<template>
  <div class="col-md-12">
     <div class="alert alert-success mb-2" v-if="success">
          {{ successMessage }}
      </div>
      <div class="alert alert-warning mb-2" v-if="error">
          {{ errorMessage }}
      </div>
    <div class="card">
      <div class="card-header bg-white">Referral Page</div>
      <div class="card-body">
        <h5><strong class="text-success"> Referral By : {{ referral.referred_by.name}}</strong></h5>
        <h5 class="text-success">Patient Details</h5>
        <app-show-patient :patient="referral.patient"></app-show-patient>

        <div>
          <label><strong class="text-success"> Remarks: </strong></label>
          <p> {{ referral.notes }}</p>
        </div>
        <hr>

        <div>
          <div class="form-group">
            <label>Referral Report:</label>
            <textarea class="form-control" v-model="report">
            
            </textarea>
          </div>
         
          <button class="btn btn-success" :disabled="!report" v-if="!submitting"
              @click.prevent="sendReport">Send Report</button>

          <button class="btn btn-success " type="button" disabled  v-else>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Saving...
          </button>
        
          
        </div>
      

      </div>
    </div>

  </div>
</template>

<script>
import axios from "axios";
import Patient from './ShowPatient.vue'
export default {
  props:['referral', 'department'],

  components:{
    'app-show-patient':Patient
  },



  data() {
    return {
        report:'',   
        success:false,
        error:false,
        errorMessage:'',
        successMessage:'',
        submitting: false,
    };
  },

  methods: {
    sendReport(){
      const data ={
        referralId: this.referral.id,
        report: this.report
      }
      this.submitting = true;
      axios.post('/referral/record/',data)
      .then(()=>{

        this.error = this.submitting =false;
        this.success = true;
        this.successMessage =' Patient Report Sent';

        setTimeout(()=>{
           window.location.href ="/"+ this.department +"/referrals"
        }, 2000)
       
      })
      .catch(err=>{
          console.log(err)         
          this.submitting = false
          this.error = true;
          this.errorMessage = err.response.data.message || "Error saving the saving data";
      })
    },

    
  }
};
</script>

