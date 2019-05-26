<template>
  <div class="col-md-12">
     <div class="alert alert-success mb-2" v-if="success">
          {{ successMessage }}
      </div>
      <div class="alert alert-warning mb-2" v-if="error">
          {{ errorMessage }}
      </div>
    <div class="card">
      <div class="card-header bg-white">Visit Page</div>
      <div class="card-body">
        <!-- You are logged in as receptionist! -->

        <h5 class="text-success">Patient Details</h5>
        <app-show-patient :patient="visit.patient"></app-show-patient>
        <div>
          <div class="form-group">
            <label>Patient Notes:</label>
            <textarea class="form-control" v-model="notes">
            
            </textarea>
          </div>
          <p>(Clicking SEEN saves notes and ends the visit session. )</p>
            
          <button class="btn btn-success" :disabled="!notes" v-if="!submitting"
              @click.prevent="markAsSeen">SEEN</button>

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
  props:['visit', 'department'],

  components:{
    'app-show-patient':Patient
  },



  data() {
    return {
        notes:'',   
        success:false,
        error:false,
        errorMessage:'',
        successMessage:'',
        submitting: false,
    };
  },

  methods: {
    markAsSeen(){
      const data ={
        visitId: this.visit.id,
        notes: this.notes
      }
      this.submitting = true;
      axios.post('/patient/seen/',data)
      .then(()=>{

        this.error = this.submitting =false;
        this.success = true;
        this.successMessage =' Patient Marked as seen';

        setTimeout(()=>{
           window.location.href ="/"+ this.department
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

