<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3">E-Wallet Services </h4>   
                <router-link to="/createservice/create" class="btn btn-primary btn-custom">Create Solo Services</router-link>  
                <router-link to="/createjointservice" class="btn btn-primary btn-custom">Create Joint Services</router-link> 
            </div>  
            <div class="card-body">
     
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-services">
                <thead>
                    <tr class="th-table">
                        <th>Service Code</th>
                        <th>Service Name</th>
                        <th>Service Type Code</th>
                        <th>Service Type Name</th>
                        <th>Available In Wallet Type</th> 
                        <th>Service Condition</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    <tr v-for="s in Services" :key="s.id"> 
                        <td> 
                            <p>
                            {{s.service_code}}  
                            </p>
                        </td> 
                        <td> 
                            <p>
                            {{s.service_name}} 
                            </p>
                        </td>
                        <td>
                            <p>
                            -----
                            </p>
                        </td>
                        <td> 
                            <p>
                            -----
                            </p>
                        </td>
                        <td> 
                            <p>
                            {{s.s_wallet_type}}
                            </p>
                        </td>
                        <td> 
                            <p>
                            {{s.wallet_condition}} 
                            </p>
                        </td>
                        <td> 
                            <router-link :to="{ name: '/update-service', params: { id: s.id, method_name: 'view' }}" class="btn btn-primary btn-custom" v-if="method_name === 'view' && s.wallet_condition =='solo'">Update</router-link>  
                            <router-link :to="{ name: 'list-joint-services', params: { id: s.id }}" class="btn btn-primary btn-custom" v-if="method_name === 'view' && s.wallet_condition =='joint'">View</router-link> 
                            <router-link :to="{ name: '/update-service', params: { id: s.id, method_name: 'joint' }}" class="btn btn-primary btn-custom" v-if="method_name === 'joint' && s.wallet_condition === 'solo'" :hidden="checksExistId(s.id)"> Add</router-link> 
                            <a href="#" class="badge badge-secondary" v-show="checksExistId(s.id) && method_name === 'joint'">TAKEN</a> 
                            <a href="#" class="badge badge-secondary" v-show="method_name === 'joint' && s.wallet_condition === 'joint'">UNAVAILABLE</a>
                        </td>   
                    </tr>  
               
                </tbody>
                </table> 

                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
/**
 * This module is related with other modules to be completed.
 */
 data() {
     return {
           Services : {},
           method_name: this.$route.params.method_name,
           joint_services : JSON.parse(localStorage.getItem('list_services'))
     }
   
 },
 methods : {
        showDatatable(){
            setTimeout(function(){
                let table = $('#table-services').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: true,
                });
            }, 400);
        },
        showServices() {
            axios.get('/api/service/getserviceslist')
            .then(response => {
                this.Services = response.data;
                
            })
            .catch(() => {
                console.log("err");
            })
        },
        checksExistId(id){
                const joint_services = this.joint_services
                const service = obj => obj.service_id === id;
                if(joint_services !== null){
                    return joint_services.some(service); 
                }
        },
 },
 created() {
    this.showServices()
    this.showDatatable() 
 }

}
</script>

<style>

</style>