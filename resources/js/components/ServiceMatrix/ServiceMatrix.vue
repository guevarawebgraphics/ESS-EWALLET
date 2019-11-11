<template>
    <div id="ServiceMatrix">
        <!-- Box -->
        <div class="box ptb--100">
            <!-- Form -->
            <form @submit.prevent="SaveChanges()">
                <!-- Card -->
                <div class="card shadow-custom">
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Row Table -->
                        <div class="form-group row">
                            <!-- Cold lg 6 -->
                            <div class="col-md-10">
                                <div class="header-title">Services Matrix Setup</div>
                                <div class="data-tables datatable-dark">
                                    <!-- Table -->
                                    <table class="table table-hover table-bordered text-center" id="service_matrix">
                                        <thead class="text-capitalize">
                                            <tr sp>
                                                <th colspan="3"><h3>Service Matrix</h3></th>
                                                <th>Applies To:</th>
                                                <th colspan="2">Admin</th>
                                                <th colspan="2">Merchant</th>
                                                <th colspan="2">Branch</th>
                                                <th colspan="2">Agent</th>
                                            </tr>
                                            <tr>
                                                <th>Service Type</th>
                                                <th>Service Name</th>
                                                <th>Group</th>
                                                <th>Inc. Redeem</th>
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
                                            <tr v-for="sm in Services" :key="sm.id">
                                                <td>{{sm.st_name}}</td>
                                                <td>{{sm.service_name}}</td>
                                                <td>{{sm.group_description}}</td>
                                                <td>Test</td>
                                                <td><input :key="sm.id" type="checkbox" name="admin_all[]" class="form-check-input"  v-model="sm.admin_all" id="admin_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="admin_some[]" class="form-check-input" v-model="sm.admin_some" id="admin_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="merchant_all[]" class="form-check-input" v-model="sm.merchant_all" id="merchant_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="merchant_some[]" class="form-check-input" v-model="sm.merchant_some" id="merchant_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="branch_all[]" class="form-check-input" v-model="sm.branch_all" id="branch_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="branch_some[]" class="form-check-input" v-model="sm.branch_some" id="branch_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="agent_all[]" class="form-check-input" v-model="sm.agent_all" id="agent_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="agent_some[]" class="form-check-input" v-model="sm.agent_some" id="agent_some"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- ./ Table -->
                                </div>
                            </div>
                        </div>
                        <!-- ./ Row Table -->
                        <!-- Row Button -->
                        <div class="form-group row">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary btn-flat float-right"><i class="ti-save"></i> Save Changes</button>
                            </div>
                        </div>
                        <!-- ./ Row button -->
                    </div>
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
            Services: {},
            form: new Form({
                admin_all: {},
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
        datatable(){
            setTimeout(function(){
                let table = $('#service_matrix').DataTable({
                    // "searching": false,
                    "sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    //scrollX: true,
                    "autoWidth": true,
                    lengthChange: true,
                    responsive: true,
                    fixedColumns: false,
                });
            }, 900);
        },
        SaveChanges(){
            swal.fire({
                title: 'Are you sure?',
                text: "Save Service Matrix Configuration Setup",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
            }).then((result) => {
                if (result.value) {
                    axios.post('api/servicematrix/StoreServiceMatrix', this.Services)
                    .then((response) => {
                        $("#service_matrix").DataTable().destroy()
                        this.datatable();
                        this.GetServices();
                        toast.fire({
                            type: 'success',
                            title: 'Saved!'
                            })
                        
                    })
                    .catch((err) => {
                        swal.fire(
                        'Something Went Wrong!',
                        'Something Went Wrong!',
                        'error'
                        )
                    })
                    
                }
            })
        },
        GetServices(){
            axios.get('api/servicematrix/GetServices').then(({ data }) => (this.Services = data));
        }
    },
    created(){
        this.datatable();
        this.GetServices();
    }
}
</script>

<style>

</style>