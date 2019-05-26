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

          <div v-if="patientsVisits.length > 0 && !loading">
            <h5 class="text-success">Patients in Queue</h5>
            <ul class="list-group" v-for="visit in patientsVisits" :key="visit.id">
              <li class="list-group-item mb-1" style="cursor:pointer" 
                  @click.prevent="redirectToVisitDetailPage(visit.id)">
                <a :href="'/treatment/visit/'+ visit.id" style="color:black;text-decoration:none">
                  {{ visit.patient.name }}
                </a>
              </li>
             
            </ul>

          </div>
          <div v-else class="alert alert-info">
              No Patient in queue
          </div>

          
        
           

          
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios'
import Loading from './Loading.vue'
export default {
  components:{
      'app-loading': Loading,
  },
  data(){
    return {
      patientId: '',
      loading:false,
      success:false,
      error:false,
      successMessage:'',
      errorMessage:'',
      visits:[]
    }
  },

  computed:{
    patientsVisits(){
      if(this.patientId){
        return this.visits.filter(visit => visit.patient.id == this.patientId);
      }
      return this.visits;
    }
  },

  created(){
    this.fetchPatients();
  },

  methods:{
    searchPatient(){

    },
    fetchPatients(){
      this.loading = true;
      axios.get('/treatment/patients')
      .then(({data})=>{
        this.loading = false;
        this.visits  = data;
        console.log(data);
      })
      .catch(err=>{
        this.loading = false;
        console.log(err)
      })

    },

    redirectToVisitDetailPage(id){
      // alert(id);
      window.location.href = '/treatment/visit/'+id;
    }
  }
}
</script>

