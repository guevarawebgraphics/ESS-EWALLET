<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3">E-Wallet Services </h4>   
             <router-link to="/createservice" class="btn btn-primary btn-custom">Create SOLO Services</router-link>  
             
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
                        <td>{{s.service_code}} </td> 
                        <td>{{s.service_name}}t </td>
                        <td>{{s.st_code}} </td>
                        <td>{{s.st_name}} </td>
                        <td>{{s.wallet_account_type}} </td>
                        <td>---- </td>
                        <td> <router-link :to="{ name: '/test', params: { id: 1 }}" class="btn btn-primary btn-custom">Update</router-link> </td>   
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
           Services : {}
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
        }
 },
 created() {
    this.showServices()
    this.showDatatable()
 }

}
</script>

<style>

</style>