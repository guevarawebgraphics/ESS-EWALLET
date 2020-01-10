<template>
    <div id="list-of-wallet-accounts">
        <div class="box ptb--100">
            <!-- Card -->
             <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!--Form Group Row-->
                    <div class="form-group row">
                        <!-- Col -->
                        <div class="col-md-10 offset-md-2">
                            <!-- <div class="col-md-4">
                                <router-link class="btn btn-primary" to="#">List of Wallet Accounts <i class="ti-arrow-right"></i></router-link>
                            </div> -->
                            <h4 class="header-title mt-3">List of Wallet Accounts</h4>
                            <div class="data-tables datatable-dark">
                               <!-- Table -->
                                <table class="table table-striped table-responsive text-center" id="table_id">
                                    <!-- Thead -->
                                    <thead>
                                        <tr class="th-table">
                                            <th>Wallet Type</th>
                                            <th>Wallet Account Type</th>
                                            <th>Wallet Account No.</th>
                                            <th>Wallet Account Name</th>
                                            <th>Wallet Tittle</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- ./ Thead -->
                                    <!-- Tbody -->
                                    <tbody>
                                        <tr v-for="lwa in listofwalletaccount" :key="lwa.id">
                                            <td>{{ lwa.wallet_type }}</td>
                                            <td>{{ lwa.wat }}</td>
                                            <td>{{ lwa.wallet_account_no }}</td>
                                            <td>{{ lwa.wallet_account_name }}</td>
                                            <td>{{ lwa.wallet_title }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-xs text-white" @click="openAccount(lwa)">
                                                    <i class="ti-eye"></i>
                                                     Open
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- ./ Tbody -->
                                </table>
                               <!-- ./ Table -->
                            </div>
                        </div>
                        <!-- ./ Col -->
                    </div>
                </div>
                <!-- ./ Card body -->
            </div>
            <!-- ./End Card -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            listofwalletaccount: [],
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
                    "order": [3, "desc"]
                })
            }, 500);
        },
        GetallWalletAccount(){
            axios.get('api/walletaccount/ListOfWalletAccounts')
                .then(res => {
                    this.listofwalletaccount = res.data;
                })
                .catch(err => console.log(err))
        },
        openAccount(lwa){
            this.$router.push(`/walletaccountprofile/${lwa['wallet_account_no']}`)
        }
    },
    created(){
        this.GetallWalletAccount()
        this.datatable()
    }
}
</script>

<style>

</style>