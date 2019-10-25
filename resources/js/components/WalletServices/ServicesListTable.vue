<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3">E-Wallet Services </h4>   
             <router-link to="/createservice" class="btn btn-primary btn-custom">Create Services</router-link> 
            </div>  
            <div class="card-body">
     
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-service-type">
                <thead>
                    <tr class="th-table">
                        <th>Service Code</th>
                        <th>Service Name</th>
                        <th>Service Type Code</th>
                        <th>Service Type Name</th>
                        <th>Available In Wallet Type</th> 
                        <th>Merchant Wallet No.</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    <tr> 
                        <td>Test </td> 
                        <td>Test </td>
                        <td>Test </td>
                        <td>Test </td>
                        <td>Test </td>
                        <td>Test </td>
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
}
</script>

<style>

</style>