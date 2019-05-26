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
          <p>(Clicking SEEN saves notes and ends the visit session.
            If You want to save patients notes before sending a referral,
            click save notes instead. ) </p>

          <button class="btn btn-primary" :disabled="!notes" v-if="!submittingnotes"
            @click.prevent="savePatientNotes">SAVE NOTES</button>
          <button class="btn btn-success " type="button" disabled  v-else>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Saving...
          </button>
          <button class="btn btn-success" :disabled="!notes" v-if="!submitting"
              @click.prevent="markAsSeen">SEEN</button>

          <button class="btn btn-success " type="button" disabled  v-else>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Saving...
          </button>
          <button class="btn btn-danger" 
              data-toggle="modal" data-target="#referralModal">Send Referal</button>

          
        </div>
      

      </div>
    </div>

    <!--  referral modal -->


    <div class="modal fade" id="referralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Send Referal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="alert alert-success mb-2" v-if="success">
              {{ successMessage }}
            </div>
            <div class="alert alert-warning mb-2" v-if="error">
                {{ errorMessage }}
            </div>
            <div class="form-group">
                <label>Patient Name:</label>
                <input type="text" class="form-control" :value="visit.patient.name" disabled>
            </div>
            <div class="form-group">
              <label>Choose Department to Refer Patient To:</label>
              <select  class="form-control" v-model="referral.department">
                  <option value="" selected disabled>Choose ...</option>
                  <option value="laboratory">Laboratory</option>
                  <option value="radiology">Radiology</option>
                  <option value="optical">Optical</option>
                  
              </select>
            </div>
           <div class="form-group">
            <label>Remarks:</label>
                <textarea class="form-control" v-model="referral.remarks">
                </textarea>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" 
                v-if="!sendingreferral"
                @click.prevent="sendReferral"
                :disabled="!dataIsValid">Send</button>
            <button class="btn btn-success " type="button" disabled  v-else>
              <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
              Sending...
          </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Patient from './ShowPatient.vue'
export default {
  props:['visit'],

  components:{
    'app-show-patient':Patient
  },

  computed:{
    dataIsValid(){
      if(this.referral.remarks && this.referral.department){
        return true;
      }
      return false;
    }
  },

  data() {
    return {
        notes:this.visit.notes,
        referral: {
          remarks:'',
          department:''
        },
        success:false,
        error:false,
        errorMessage:'',
        successMessage:'',
        submitting: false,
        submittingnotes: false,
        sendingreferral: false,
    };
  },

  methods: {
    markAsSeen(){
      const data ={
        visitId: this.visit.id,
        notes: this.notes
      }
      this.submitting = true;
      axios.post('/treatment/patient/seen',data)
      .then(()=>{

        this.error = this.submitting =false;
        this.success = true;
        this.successMessage =' Patient Marked as seen';

        setTimeout(()=>{
           window.location.href ="/treatment"
        }, 2000)
       
      })
      .catch(err=>{
          console.log(err)         
          this.submitting = false
          this.error = true;
          this.errorMessage = err.response.data.message || "Error saving the saving data";
      })
    },

    savePatientNotes(){
      const data ={
        visitId: this.visit.id,
        notes: this.notes
      }
      this.submittingnotes = true;
      axios.post('/treatment/patient/savenotes',data)
      .then(()=>{

        this.error = this.submittingnotes =false;
        this.success = true;
        this.successMessage =' Patient Notes saved successfully';


      })
      .catch(err=>{
          console.log(err)         
          this.submittingnotes = false
          this.error = true;
          this.errorMessage = err.response.data.message || "Error saving the saving data";
      })
    },


    sendReferral(){
      const data ={
        visitId: this.visit.id,
        patientId : this.visit.patient.id,
        department: this.referral.department,
        notes: this.referral.remarks
      }

      this.sendingreferral = true;
      axios.post('/treatment/referral',data)
      .then(()=>{

        this.error = this.sendingreferral =false;
        this.success = true;
        this.successMessage =' Referral send successfully';


      })
      .catch(err=>{
          console.log(err)         
          this.sendingreferral = false
          this.error = true;
          this.errorMessage = err.response.data.message || "Error sending referral";
      })
    }
  }
};
</script>

