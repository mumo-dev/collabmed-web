<template>
<div class="w-75">
    <div class="alert alert-success" role="alert" v-show="success">
       {{ successMessage}}
     </div>
      <div class="alert alert-danger" role="alert" v-show="error">
       {{ errorMessage}}
     </div>
    <div class="card">
        <div class="card-header bg-white"><h5 class="m-0">Add New Patient</h5></div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" v-model="patient.name" required>
                </div>

                <div class="form-group">
                    <label>Age:</label>
                    <input type="number" class="form-control" v-model="patient.age" required>
                </div>

                 <div class="form-group">
                    <label>Gender:</label>
                    <select class="form-control" v-model="patient.gender">
                        <option value="">Choose ...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <button class="btn btn-info"  v-if="!loading"
                    @click="savePatient"
                    :disabled="!isValid">SAVE</button>

                <button class="btn btn-info " type="button" disabled  v-else>
                  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                  Saving...
                </button>
                
            </form>
        </div>
    </div>
</div>
</template>

<script>

    import axios from 'axios'
    export default {
        data(){
            return {
                patient:{
                    name:'',
                    gender:'',
                    age:''
                },

                loading: false,
                success: false,
                successMessage:'',
                error: false,
                errorMessage:''
            }
        },
        computed:{
            isValid(){
                if(this.patient.name && this.patient.age && this.patient.gender){
                    return true;
                }
                return false;
            }
        },

        methods:{
            savePatient(){
                this.loading = true;

                const data ={
                    name: this.patient.name,
                    age: this.patient.age,
                    gender: this.patient.gender
                };

                axios.post('/reception/patient', data)
                .then(({data})=>{
                    this.loading = false;
                    this.success = true;
                    this.error = false;
                    this.successMessage=data.message
                    this.errorMessage ='';

                    this.patient = {
                        name:'',
                        gender:'',
                        age:''
                    }

                })
                .catch(err=>{

                    console.log(err)
                   
                    this.loading = false;
                    this.success = false;
                    this.error = true;
                    this.successMessage=''
                    this.errorMessage = err.response.data.message || "Error saving the poll";
                })
            }
        }
    }
</script>
