<template>
  <div class="wallet-accounts">
    <div class="box ptb--100">
        <div class="card shadow-custom">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <router-link class="btn btn-primary" to="/createwalletaccounts">Create Wallet Account <i class="ti-arrow-right"></i></router-link>
                        </div>
                            <h4 class="header-title mt-3">Elektronik Pitaka</h4>
                            <div class="data-tables datatable-dark">
                            <table class="table table-striped" id="table_id">
                            <thead>
                                <tr>
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
                                <tr v-for="wa in WalletAccount" :key="wa.id">
                                    <!-- <td><router-link :to="{ name: '/test', params: { id: 1 }}" :key="$route.fullPath">User</router-link></td> -->
                                    <td>{{wa.wallet_type}}</td>
                                    <td>{{wa.wallet_account_type}}</td>
                                    <td>{{wa.wallet_account_no}}</td>
                                    <td>{{wa.wallet_account_name}}</td>
                                    <td>{{wa.ess_id}}</td>
                                    <td v-if="wa.AccountStatus = 1"><span class="badge badge-primary">Active</span></td>
                                    <td v-else>Deactivated</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="#EditWalletAccount" @click="editWalletAccount(wa)">
                                            <i class="fa fa-edit blue"></i>
                                            <span>Update</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
            editmode: false,
            WalletAccount : [],
        }
    },
    methods: {
        loadWalletAccounts() {
            // axios({
            //     method: 'get',
            //     url: 'http://127.0.0.1:8080/api/users',
            //     dataType: 'json',
            //     contentType: 'application/json',
            //     secure: true,
            //     headers: {
            //     "Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU3MTM4MDE4NywiZXhwIjoxNTcxNDY2NTg3LCJuYmYiOjE1NzEzODAxODcsImp0aSI6Ikw5WnNXbXhkdFdLYm9pR1IiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.S4k-b9vxwPtwbEBONyT1yxvK5-LYyrzGq0r5C0GJBsk',
            //     },
            // })
            // .then(({ data }) => (this.users = data));
            axios.get('api/walletaccount/GetWalletAccount').then(({ data}) => (this.WalletAccount = data));
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
                });
            },1000);
        },
        editWalletAccount(wa){
            this.$router.push('/createwalletaccounts')
        }
    },
    mounted() {
        this.loadWalletAccounts();
        this.datatable();
       
    }
}
</script>

<style lang="scss" scoped>
th {
    text-align:  center;
}
td {
    text-align: center;
}
</style>