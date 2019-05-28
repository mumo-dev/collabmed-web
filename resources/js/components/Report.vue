<template>
  <div class="col-md-12">
    
    <div class="card">
      <div class="card-header bg-white">Patients Report Page 
      </div>
      <div class="card-body">
        <!-- You are logged in as receptionist! -->

        <!-- <h5 class="text-success">Patient Seen: {{ visit.seen?'TRUE':'FALSE'}}</h5> -->
        <h6 class="text-success">Patient Details</h6>
      
        <app-show-patient :patient="visit.patient"></app-show-patient>
        <hr>

        <table class="table w-75">
  
            <tr>
              <th>Department:</th>
              <td>{{ visit.department}} </td>
            </tr>
            <tr>
              <th>Medical Practitioner:</th>
              <td>{{ visit.medical_practitioner.name}}</td>
            </tr>
            <tr>
              <th>Date:</th>
              <td>{{ visit.created_at}}</td>
            </tr>

          </table>
        <!-- <div v-for="referral in visit.referrals" :key="referral.id" class="p-2 m-1 bg-light">
          <label>
            <strong class="text-success"> 
              Referral report from {{ referral.department }} Department {{ referral.updated_at}}
            </strong></label>
          <p> {{ referral.reports }}</p>
        </div> -->
        <hr>
        <div>
          <label><strong>Patient Notes:</strong></label>
          <div class="p-2 rounded bg-light">
            <p> {{ visit.notes}}</p>
          </div>
        </div>
      

      </div>
    </div>
  </div>
</template>

<script>
import Patient from './ShowPatient.vue'
export default {
  props:['visit'],

  components:{
    'app-show-patient':Patient
  },
};
</script>

