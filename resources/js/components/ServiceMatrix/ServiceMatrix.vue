<template>
    <div id="ServiceMatrix">
        <!-- Box -->
        <div class="box ptb--100">
            <!-- Form -->
            <form @submit.prevent="saveChanges()">
                <!-- Card -->
                <div class="card shadow-custom">
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Row Table -->
                        <div class="form-group row">
                            <!-- Cold lg 12 -->
                            <div class="col-md-12">
                                <div class="header-title text-center">Services Matrix Setup</div>
                                <hr>
                                <div class="float-right">
                                    <div class="search-box">
                                        <form action="#">
                                            <input class="form-control mb-3" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                                            <i class="ti-search"></i>
                                        </form>
                                    </div>
                                </div>
                                <div class="data-tables datatable-dark">
                                    <!-- Table -->
                                    <table class="table table-hover table-bordered table-striped text-center" id="service_matrix">
                                        <thead class="text-capitalize">
                                            <tr class="th-table">
                                                 <th colspan="3"><h3>Service Matrix</h3></th>
                                                <!-- <th>Applies To:</th> -->
                                                <th colspan="2">Admin</th>
                                                <th colspan="2">Merchant</th>
                                                <th colspan="2">Branch</th>
                                                <th colspan="2">Agent</th>
                                            </tr>
                                            <tr class="th-table">
                                                <th>Service Type</th>
                                                <th>Service Name</th>
                                                <th>Group</th>
                                                <!-- <th>Inc. Redeem</th> -->
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="sm in Services.data" :key="sm.id">
                                                <td>{{sm.st_name}}</td>
                                                <td>{{sm.service_name}}</td>
                                                <td>{{sm.group_description}}</td>
                                                <!-- <td>Test</td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.admin" name="admin[]" class="custom-control-input" v-bind:id="'admin' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.admin == true" v-bind:for="'admin' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.admin == false" v-bind:for="'admin' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.merchant" name="merchant[]" class="custom-control-input" v-bind:id="'merchant' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.merchant == true" v-bind:for="'merchant' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.merchant == false" v-bind:for="'merchant' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.branch" name="branch[]" class="custom-control-input" v-bind:id="'branch' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.branch == true" v-bind:for="'branch' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.branch == false" v-bind:for="'branch' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.agent" name="agent[]" class="custom-control-input" v-bind:id="'agent' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.agent == true" v-bind:for="'agent' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.agent == false" v-bind:for="'agent' + sm.id">SOME</label>
                                                    </div>
                                                </td> -->
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="admin_all[]" class="form-check-input" v-model="sm.admin_all" id="admin_all"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="admin_some[]" class="form-check-input" v-model="sm.admin_some" id="admin_some"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="merchant_all[]" class="form-check-input" v-model="sm.merchant_all" id="merchant_all"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="merchant_some[]" class="form-check-input" v-model="sm.merchant_some" id="merchant_some"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="branch_all[]" class="form-check-input" v-model="sm.branch_all" id="branch_all"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="branch_some[]" class="form-check-input" v-model="sm.branch_some" id="branch_some"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="agent_all[]" class="form-check-input" v-model="sm.agent_all" id="agent_all"></td>
                                                <td><input :key="sm.id" :disabled="mode == 1" type="checkbox" name="agent_some[]" class="form-check-input" v-model="sm.agent_some" id="agent_some"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- ./ Table -->
                                    <div class="text-center" v-if="this.Services.data == 0">
                                        <label>No Results found</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./ Row Table -->
                        <!-- Row Button -->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button v-if="mode == 0" type="submit" class="btn btn-primary float-right"><i class="ti-save"></i> Save Changes</button>
                            </div>
                        </div>
                        <!-- ./ Row button -->
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer bg-white">
                        <!-- Pagination Length -->
                        <div class="float-left">
                            {{ (Services.next_page_url == null && Services.prev_page_url == null) ? '' : 'Total ' + Services.to }}
                            {{ (Services.next_page_url == null && Services.prev_page_url == null) ? '' : 'of ' + Services.total }}
                        </div>
                        <!-- Pagination -->
                        <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                        <pagination class="float-right mb-3" :data="Services" @pagination-change-page="getResults">
                            <span slot="prev-nav"><i class="ti-angle-left"></i> Previous</span>
                            <span slot="next-nav">Next <i class="ti-angle-right"></i></span>
                        </pagination>
                        <!-- Pagination -->
                    </div>
                    <!-- ./ Card Footer -->
                </div>
                <!-- ./ Card -->
            </form>
            <!-- ./ Form -->
        </div>
        <!-- ./ Box -->
    </div>
</template>

<script>
export default {
    data(){
        return {
            message: null,
            typing: null,
            debounce: null,
            mode: 0,
            currentUser: window.user.user_type_id,
            Services: {},
            form: new Form({
                admin: {},
                admin_some: {},
                merchant_all: {},
                merchant_some: {},
                branch_all: {},
                branch_some: {},
                agent_all: {},
                agent_some: {},
            })
        }
    },
    methods: {
        datatable() {
            setTimeout(function(){
                let table = $('#service_matrix').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    //scrollX: true,
                    "autoWidth": true,
                    lengthChange: true,
                    responsive: true,
                    fixedColumns: false,
                });
            }, 1000);
        },
        getResults(page = 1) {
            axios.get(`/api/servicematrix/showServices?page=${page}`)
                .then(response => {
                    this.Services = response.data;
                });
        },
        saveChanges() {
            swal.fire({
                title: 'Are you sure?',
                text: "Save Service Matrix Configuration Setup",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
            }).then((result) => {
                this.$Progress.start()
                if (result.value) {
                    axios.post('api/servicematrix/storeServiceMatrix', this.Services)
                    .then((response) => {
                        console.log(response)
                        this.$Progress.increase(10)
                        this.$Progress.finish()
                        // $("#service_matrix").DataTable().destroy()
                        // this.datatable();
                        this.getServices();
                        toast.fire({
                            type: 'success',
                            title: 'Saved!'
                        })
                        
                    })
                    .catch((err) => {
                        this.$Progress.fail()
                        swal.fire(
                            'Something Went Wrong!',
                            'Something Went Wrong!',
                            'error'
                        )
                    })
                    
                }
            })
        },
        getServices() {
            axios.get('api/servicematrix/showServices').then(({ data }) => (this.Services = data));
        },
        getServiceMatrixConfig() {
            axios.get('api/servicematrix/ServiceMatrixConfig')
                .then(({ data }) => (this.Services = data))
                .catch(err => {
                    console.log(err)
                })
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
                    axios.get(`/api/servicematrix/searchServiceMatrix/${this.message}`)
                    .then(response => {
                        this.Services = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.getServices()
                }
            }, 600)
        },
    },
    created() {
        // this.datatable();
        if(this.currentUser === 3){
            this.mode = 1;
            this.getServiceMatrixConfig()
        }
        else {
            this.mode = 0;
            this.getServices();
        }
        
        
        console.log(this.$route.name)
    }
}
</script>

<style>

</style>