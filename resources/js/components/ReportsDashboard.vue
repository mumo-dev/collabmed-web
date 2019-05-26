<template>
<div class="col-md-8">
  <div class="card">
    <div class="card-header bg-white"> Reports Dashboard 
    </div>
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

          <div v-if="visits.length > 0 && !loading">
            <h5 class="text-success">Reports for {{ visits[0].patient.name }}</h5>
            <ul class="list-group" v-for="visit in visits" :key="visit.id">
              <li class="list-group-item mb-1" style="cursor:pointer" 
                  @click.prevent="redirectToVisitDetailPage(visit.id)">
                 <a  style="color:black;text-decoration:none">
                  {{ visit.created_at }}
                 </a>
              </li>
             
            </ul>

          </div>
          <div   class="alert alert-info" v-show="patientNotFound">
               Patient Not Found
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
      patientNotFound:false,
      visits:[]
    }
  },

  

  

  methods:{
    searchPatient(){
      this.loading = true;
      this.patientNotFound = false;
      const url = '/admin/reports/patient/'+ this.patientId;

      axios.get(url)
      .then(({data})=>{
        this.loading = false;
        this.visits  = data;
        if(data.length == 0){
          this.patientNotFound = true;
        }
        console.log(data)
        
      })
      .catch(err=>{
        this.loading = false;
        console.log(err)
      })

    },

    

    redirectToVisitDetailPage(id){
       window.location.href = '/admin/reports/'+id;
    }
  }
}
</script>

