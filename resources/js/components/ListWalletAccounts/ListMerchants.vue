<template>
    <div id="list-merchants">
        <div class="box ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Form Group Row -->
                    <div class="form-group row">
                        <!-- Col -->
                        <div class="col-md-12">
                            <h4 class="header-title mt-3">
                                List of Merchants Accounts - {{ wan }}
                            </h4>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table striped text-center" id="table_id">
                                    <!-- Thead -->
                                    <thead>
                                        <tr class="th-table">
                                            <th>Wallet Type</th>
                                            <th>Account Type</th>
                                            <th>Account No.</th>
                                            <th>Account Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- ./ Thead -->
                                    <!-- TBody -->
                                    <tbody>
                                        <tr v-for="merchants in lm" :key="merchants.id">
                                            <td>{{ merchants.wallet_type }}</td>
                                            <td>{{ merchants.wat }}</td>
                                            <td>{{ merchants.wallet_account_no }}</td>
                                            <td>{{ merchants.wallet_account_name}}</td>
                                            <td>
                                                <a class="btn btn-secondary btn-xs disabled" href="#Details">Details</a>
                                                <router-link class="btn btn-secondary btn-xs" to="/ServiceMatrix">Service Matrix</router-link>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- ./ Tobody -->
                                </table>
                                <!-- ./ Table -->
                            </div>
                        </div>
                        <!-- ./ Col -->
                    </div>
                    <!-- ./ Card body -->
                </div>
                <!-- ./ Card Body -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
     data(){
         return{
             lm: [],
             wan: this.$route.params.uid
         }
     },
     methods: {
        datatable(){
            setTimeout(function() {
                $('#table_id').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: false,
                    "order": [4, "desc"]
                })
            }, 500);
        },
        listMerchants(){
            axios.get('/api/walletaccount/ListofMerchantsAccounts')
                .then(res => {
                    this.lm = res.data;
                })
                .catch(err => {
                    console.log(err)
                })
        }
     },
     created(){
         this.datatable()
         this.listMerchants()
     }
}
</script>

<style>

</style>