<template>
  <div class="wallet-accounts">
      <div class="card-area">
          <!-- <div class="row">
              <div class="col-md-9 col-md-6 mt-5">
                    <div class="card card-bordered">
                        <img class="card-img-top img-fluid" src="assets/images/card/card-img1.jpg" alt="image">
                        <div class="card-body">
                        <h5 class="title">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dicta.</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia adipisci quidem, quam nam reiciendis facere blanditiis atque neque architecto omnis magni totam, voluptate maiores, iusto molestias incidunt unde nesciunt cum.
                        </p>
                        <a href="#" class="btn btn-primary">Go More....</a>
                        </div>
                    </div>
                </div>
          </div> -->
      </div>
      <!-- Primary table start -->
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                            <div class="col-md-4">
                                <router-link class="btn btn-primary" to="/createwalletaccounts">Create Wallet Account <i class="ti-arrow-right"></i></router-link>
                            </div>
                                <h4 class="header-title mt-3">Elektronik Pitaka</h4>
                                <!-- <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <tbody class="text-capitalize">
                                            <tr>
                                                <th>Wallet Type</th>
                                                <th>Account Type</th>
                                                <th>Account No</th>
                                                <th>Account Name</th>
                                                <th>ESS USER ID</th>
                                                <th>STATUS</th>
                                            </tr>
                             
                                            <tr v-for="user in users.data" :key="user.id">
                                                <td>{{user.name}}</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>asd</td>
                                                <td>2008/11/28</td>
                                                <td>$162,700</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                                <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                <thead class="thead-dark">
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
                                    <tr>
                                        <td>Admin</td>
                                        <td>Admin</td>
                                        <td>111-222-333</td>
                                        <td>admin</td>
                                        <td>admin</td>
                                        <td>Active</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                             <!-- /.card-body -->
                            <div class="card-footer">
                                <pagination :data="users" @pagination-change-page="getResults"></pagination>
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
            users : {},
        }
    },
    methods: {

    },
    created() {

    }
}
</script>

<style>

</style>