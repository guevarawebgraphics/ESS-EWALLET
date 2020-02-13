<template>
  <div class="wallet-accounts">
    <div class="box col-md-12 ptb--100">
        <div class="card shadow-custom">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <router-link class="btn btn-primary btn-sm float-left mb-3" to="/createwalletaccount">Create Wallet Account <i class="ti-pencil-alt"></i></router-link>
                        <div class="float-right">
                            <div class="search-box">
                                <form action="#" @keydown.prevent.enter.self>
                                    <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account..." required>
                                    <i class="ti-search"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                        </div>
                            <!-- <h4 class="header-title mt-3 text-center">Wallet Accounts</h4> -->
                            <hr>
                            <!-- <router-link class="btn btn-primary btn-sm float-left mb-3" to="/createwalletaccount">Create Wallet Account <i class="ti-pencil-alt"></i></router-link> -->
                            <div class="data-tables datatable-dark">
                            <table class="table table-hover table-bordered table-striped text-center" id="table_id">
                            <thead>
                                <tr class="th-table">
                                    <th>Wallet Type</th>
                                    <th>Account Type</th>
                                    <th>Account No</th>
                                    <th>Account Name</th>
                                    <th>ESS USER ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="wa in WalletAccount.data" :key="wa.id">
                                    <!-- <td><router-link :to="{ name: '/test', params: { id: 1 }}" :key="$route.fullPath">User</router-link></td> -->
                                    <td>{{wa.wallet_type}}</td>
                                    <td>{{wa.wallet_account_type}}</td>
                                    <td>{{wa.wallet_account_no}}</td>
                                    <td>{{wa.wallet_account_name}}</td>
                                    <td>{{wa.ess_id}}</td>
                                    <td v-if="wa.AccountStatus = 1"><span class="badge badge-primary">Active</span></td>
                                    <td v-else>Deactivated</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="#EditWalletAccount" @click="editWalletAccount(wa.ess_id)">
                                            <i class="fa fa-edit blue"></i>
                                            <span>Update</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <div class="text-center" v-if="this.WalletAccount.data == 0">
                            <label>No Results found</label>
                        </div>

                        <div class="text-center" v-if="WalletAccount.data === undefined">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="card-footer bg-white">
                <!-- Pagination Length -->
                <div class="float-left">
                      {{ (WalletAccount.next_page_url == null && WalletAccount.prev_page_url == null) ? '' : 'Total ' + WalletAccount.to }}
                      {{ (WalletAccount.next_page_url == null && WalletAccount.prev_page_url == null) ? '' : 'of ' + WalletAccount.total }}
                </div>
                <!-- Pagination -->
                <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults">
                    <span slot="prev-nav">&lt; Previous</span>
                    <span slot="next-nav">Next &gt;</span>
                </pagination>
                <!-- Pagination -->
            </div>
            <!-- ./ Card Footer -->
        </div>
    </div>
      <!-- Primary table start -->
    <div class="col-md-12 mt-5">
        
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            message: null,
            typing: null,
            debounce: null,
            editmode: false,
            editmode: false,
            WalletAccount : {},
        }
    },
    methods: {
        getResults(page = 1) {
            axios.get(`api/walletaccount/showAllWalletAccount?page=${page}`)
                .then(response => {
                    this.WalletAccount = response.data;
                });
        },
        loadWalletAccounts() {
            axios.get('api/walletaccount/showAllWalletAccount')
            .then(response => {
                this.WalletAccount = response.data;
            });
        },
        datatable() {
            setTimeout(function(){
                $('#table_id').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: true,
                    "order": [6, "desc"]
                });
            },1000);
        },
        editWalletAccount(ess_id) {
            this.$router.push('/updatewalletaccount/' + ess_id)
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
                    axios.get(`api/walletaccount/searchWalletAccount/${this.message}`)
                    .then(response => {
                        this.WalletAccount = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.loadWalletAccounts()
                }
            }, 600)
        }
    },
    mounted() {
        this.loadWalletAccounts();
        //this.datatable();
       
    }
}
</script>

<style lang="scss" scoped>
</style>