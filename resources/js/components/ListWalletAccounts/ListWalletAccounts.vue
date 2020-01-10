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
                        <div class="col-md-10">
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
                                            <th>Services</th>
                                            <th>Merchants</th>
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
                                            <!-- <td>
                                                <a class="btn btn-primary btn-xs text-white" @click="openAccount(lwa)">
                                                    <i class="ti-eye"></i>
                                                     Open
                                                </a>
                                            </td> -->
                                            <td>
                                                <a class="btn btn-primary btn-md text-white btn-xs disabled" v-on:click="goToAvailableServices( lwa.wallet_account_no)">Available Services</a>
                                            </td>
                                            <td>
                                                <router-link :to="{ name: 'List of Merchants', params: { uid: lwa.wallet_account_no }}" class="btn btn-primary btn-md text-white btn-xs">
                                                    <span> <i class="ti-user"></i></span>
                                                    List of Merchants
                                                </router-link>
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
                    "order": [6, "desc"]
                })
            }, 1000);
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
        },
        back(){
            this.$router.push('/listwalletaccounts')
        },
        goToAvailableServices(wan){
            this.$router.push(`/walletaccountprofile/${wan}/ListServices`)
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