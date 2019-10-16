<template>
  <div class="wallet-accounts">
      <div class="card-area">
      </div>
      <!-- Primary table start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
            <div class="col-md-4">
                <router-link class="btn btn-primary" to="/createwalletaccounts">Create Wallet Account <i class="ti-arrow-right"></i></router-link>
            </div>
                <h4 class="header-title mt-3">Elektronik Pitaka</h4>
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table_id">
                <thead>
                    <tr>
                        <th>Wallet Type</th>
                        <th>Account Type</th>
                        <th>Account No</th>
                        <th>Account Name</th>
                        <th>ESS USER ID</th>
                        <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <!-- <td>PREPAID</td> -->
                        <td><router-link :to="{ name: '/test', params: { id: 1 }}" :key="$route.fullPath">User</router-link></td>
                        <td>{{user.type_name}}</td>
                        <td>111-222-333</td>
                        <td>{{user.accountname}}</td>
                        <td>{{user.username}}</td>
                        <td v-if="user.AccountStatus = 1">Active</td>
                        <td v-else>Deactivated</td>
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
            editmode: false,
            users : [],
        }
    },
    methods: {
        loadusers() {
            axios({
                method: 'get',
                url: 'http://127.0.0.1:8080/api/users',
                dataType: 'json',
                contentType: 'application/json',
                secure: true,
                headers: {
<<<<<<< HEAD
                "Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU3MDc2NTkxMywiZXhwIjoxNTcwODUyMzEzLCJuYmYiOjE1NzA3NjU5MTMsImp0aSI6IkE4dFBKWU9iZTVjamcxeFgiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.H1uOMS_JnI1Ev_9fUExWOTAEudk75KJ3AnD-clZQqKc',
=======
                "Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU3MTIwMjM3OCwiZXhwIjoxNTcxMjg4Nzc4LCJuYmYiOjE1NzEyMDIzNzgsImp0aSI6IkV2NURxdHoxdzlTTzBkeUQiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.-as4VP-DL3akZjvMVmKaU_OnB3jFOgEplRmtN9IT5hA',
>>>>>>> 5bf0b629920bd9adeca3ffd22d70d4a51f8fc900
                },
            })
            .then(({ data }) => (this.users = data));
        },
        datatable() {
            setTimeout(function(){
                $('#table_id').DataTable({
                    responsive: true
                });
            },1000);
        }
    },
    mounted() {
        this.loadusers();
        this.datatable();
       
    }
}
</script>

<style>

</style>