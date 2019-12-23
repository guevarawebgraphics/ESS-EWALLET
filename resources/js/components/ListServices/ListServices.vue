<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3">List of Services - Acct No. {{this.wi}}</h4>   
            </div>  
            <div class="card-body">
     
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-services">
                <thead>
                    <tr class="th-table">
                        <th>Service Type </th> 
                        <th>Service Name</th>
                        <th>Service Description</th> 
                        <th>Redeem Wallet No.</th>
                        <th>Redeem Wallet Acct. Name</th>
                        <th></th>
                    </tr>  
                </thead>
                <tbody>
                    <tr v-for="s in ListServices" :key="s.id"> 
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>---</td>
                        <td>
                             <router-link :to="{ name: '/update-service', params: { id: s.id, method_name: 'joint' }}" class="btn btn-primary btn-custom"> Transact</router-link> 
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
data() {
    return {
            ListServices : [] ,
            wi : this.$route.params.wi
    }
},
methods: {
    getListServices() {
            axios.get('/api/service/getserviceslist')
            .then(response => {
                this.ListServices = response.data;
            })
            .catch(() => {
                console.log("err");
            })
    },
},
created(){
    this.getListServices();
}
}
</script>

<style>

</style>