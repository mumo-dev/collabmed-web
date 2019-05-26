<template>
<div class="col-md-8">
<div class="card">
    <div class="card-header bg-white">Dashboard</div>
    <div class="card-body">
        <!-- You are logged in as receptionist! -->
        <div class="d-flex">
          <input type="search" class='form-control mr-1' v-model="patientId" 
            placeholder="Search by Patient ID..." >
            <button class="btn btn-info" @click.prevent="searchPatient">search</button>
          </div>

          <hr>
          <div v-if="loading">
              <app-loading></app-loading>
          </div>
          <div class="alert alert-success mb-2" v-if="success">
              {{ successMessage }}
          </div>
          <div class="alert alert-warning mb-2" v-if="error">
              {{ errorMessage }}
          </div>
          <div class="" v-if="!loading && patient.name">
            
              <app-show-patient :patient="patient"></app-show-patient>

              <h6><strong class="text-success">Choose Department To Refer Patient to: </strong> </h6>
              <select  class="form-control" v-model="department">
                  <option value="" selected disabled>Choose ...</option>
                  <option value="nursing">Nursing</option>
                  <option value="laboratory">Laboratory</option>
                  <option value="radiology">Radiology</option>
                  <option value="treatment">Treatment</option>
                  <option value="optical">Optical</option>
                  
              </select>

              <button class="btn btn-info mt-1"
                       v-if="!submitting" 
                      :disabled="!department"
                      @click.prevent="checkInPatient">
                      Check In Patient
              </button>
              <button class="btn btn-info " type="button" disabled  v-else>
                  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                  Checking in...
              </button>

          </div>
           

          
    </div>
  </div>
</div>
</template>

<script>

    import axios from 'axios'
    import Loading from './Loading.vue'
    import Patient from './ShowPatient.vue'
    export default {
       components:{
         'app-loading': Loading,
         'app-show-patient':Patient
       },

       

        data(){
          return {
             patientId:'',
             loading: false,
             patient:{},
             error: false,
             success:false,
             errorMessage:'',
             successMessage:'',
             department:'',
             submitting:false
          }
        },

        methods:{
          searchPatient(){
            this.loading = true;
            this.patient ={}
            this.error = this.success = false,
            this.errorMessage = this.successMessage = ''
            axios.get('/reception/patient/get/'+ this.patientId)
              .then((result) => {
                 this.loading = false;
                 this.patient = result.data
                
              
              }).catch((err) => {
                 this.loading = false;
                 this.error = true;
                 this.errorMessage = err.response.data.message || 'Some Error Occurred'
                 
              });
          },

          checkInPatient(){
            this.submitting = true;
            this.error = false,
            this.errorMessage=''

            const data ={
              patientId: this.patient.id,
              department: this.department
            }
            axios.post('/reception/checkin/', data)
              .then((result) => {
                 this.submitting = this.error= false;
                 this.success = true;
                 this.successMessage = 'Patient Checked In successfully'
       
              }).catch((err) => {
                 this.submitting = false;
                 this.error = true;
                 this.errorMessage = err.response.data.message || 'Some Error Occurred'
                
              });
          }

        },


    }
</script>
