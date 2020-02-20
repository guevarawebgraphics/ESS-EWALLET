<template>
    <div id="list-of-wallet-accounts">
        <div class="box ptb--100">
            <!-- Card -->
             <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!--Form Group Row-->
                    <div class="row">
                        <!-- Col -->
                        <div class="col-md-12">
                            <!-- <div class="col-md-4">
                                <router-link class="btn btn-primary" to="#">List of Wallet Accounts <i class="ti-arrow-right"></i></router-link>
                            </div> -->
                            <h4 class="header-title mt-3 text-center">List of Wallet Accounts</h4>
                            <hr>
                            <div class="float-right">
                                <div class="search-box">
                                    <form action="#" @keydown.prevent.enter.self>
                                        <input class="form-control mb-3" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account..." required>
                                        <i class="ti-search"></i>
                                    </form>
                                </div>
                            </div>
                            <div class="data-tables datatable-dark">
                               <!-- Table -->
                                <table class="table table-striped table-bordered table-hover text-center" id="table_id">
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
                                        <tr v-for="lwa in listofwalletaccount.data" :key="lwa.id">
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
                                                <a class="btn btn-primary btn-md text-white btn-xs" v-on:click="goToAvailableServices( lwa.wallet_account_no)">Available Services</a>
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
                            <div class="text-center" v-if="this.listofwalletaccount.data == 0">
                                <label>No Results found</label>
                            </div>

                            <div class="text-center" v-if="listofwalletaccount.data === undefined">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                            </div>

                            </div>
                        </div>
                        <!-- ./ Col -->
                    </div>
                </div>
                <!-- ./ Card body -->
            <!-- Card Footer -->
            <div class="card-footer bg-white">
                <!-- Pagination Length -->
                <div class="float-left">
                    {{ (listofwalletaccount.next_page_url == null && listofwalletaccount.prev_page_url == null) ? '' : 'Total ' + listofwalletaccount.to }}
                    {{ (listofwalletaccount.next_page_url == null && listofwalletaccount.prev_page_url == null) ? '' : 'of ' + listofwalletaccount.total }}
                </div>
                <!-- Pagination -->
                <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                <pagination class="float-right" :data="listofwalletaccount" @pagination-change-page="getResults">
                    <span slot="prev-nav"><i class="ti-angle-left"></i>  Previous</span>
                    <span slot="next-nav">Next <i class="ti-angle-right"></i> </span>
                </pagination>
                <!-- Pagination -->
            </div>
            <!-- ./ Card Footer -->
            </div>
            <!-- ./End Card -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            message: null,
            typing: null,
            debounce: null,
            listofwalletaccount: {},
        }
    },
    methods: {
        getResults(page = 1) {
            axios.get(`api/walletaccount/showListWalletAccounts?page=${page}`)
                .then(response => {
                    this.listofwalletaccount = response.data;
                });
        },
        GetallWalletAccount(){
            axios.get('api/walletaccount/showListWalletAccounts')
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
        },
        debounceSearch(event) {
            this.message = null
            this.typing = 'You are typing'
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                this.typing = null
                this.message = event.target.value
                //console.log(this.message)
                if(this.message !== "") {
                    axios.get(`/api/walletaccount/searchlistwalletaccount/${this.message}`)
                    .then(response => {
                        this.listofwalletaccount = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.GetallWalletAccount()
                }
            }, 600)
        },
    },
    created(){
        this.GetallWalletAccount()
    }
}
</script>

<style>

</style>