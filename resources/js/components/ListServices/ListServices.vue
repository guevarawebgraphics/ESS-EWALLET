<template>
    <div class="container">
     <div id="list-of-service">
         <!-- Box -->
            <div class="box ptb--100">
                <!-- Card -->
                <div class="card shadow-custom">
                    <div class="col-md-12">
                        <h4 class="header-title mt-3">List of Services - Acct No. {{this.wi}}</h4>   
                    </div>  
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="data-tables datatable-dark">
                        <!-- Table -->
                            <table class="table table-hover table-stripe table-responsive" id="table-services">
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
                                        <td>{{ s.s_wallet_type }}</td>
                                        <td>{{ s.service_name }}</td>
                                        <td>{{ s.service_description }}</td>
                                        <td>{{ s.rwan }}</td>
                                        <td>{{ s.rname }}</td>
                                        <td>
                                            <router-link to="/prefundECPay" class="btn btn-primary btn-custom"> Transact</router-link> 
                                        </td>   
                                    </tr>  
                                </tbody>
                            </table> 
                        <!-- ./ Table -->
                        </div>
                    </div>
                    <!-- ./ Card body -->
                </div>
                <!-- ./ Card -->
            </div>
         <!-- ./ Box -->
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
    datatable(){
        setTimeout(function() {
            $('#table-services').DataTable({
                "paging": true,
                "pageLength": 10,
                scrollY: true,
                "autoWidth": true,
                //lengthChange: false,
                responsive: true,
                fixedColumns: false,
                "order": [3, "desc"]
            });
        }, 1000);
    },
    getListServices() {
        axios.get('/api/service/listservices')
            .then(response => {
                this.ListServices = response.data;
            })
            .catch((err) => {
                console.log(err);
            })
    },
},
created(){
    this.datatable()
    this.getListServices();
}
}
</script>

<style>

</style>