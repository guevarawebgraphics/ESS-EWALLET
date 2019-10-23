<template>
    <div id="serviceGroup">
        <!-- Box -->
        <div class="box ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Row Table -->
                    <div class="form-group row">
                        <!-- Col lg 6 -->
                        <div class="col-md-6">
                            <div class="header-title">Service Group</div>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table table-hover table-striped text-center" id="service_group_table">
                                    <thead class="text-capitalize">
                                        <tr>
                                            <th>Group Code</th>
                                            <th>Group Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="sg in serviceGroups" :key="sg.id">
                                            <td>{{ sg.group_code}}</td>
                                            <td>{{ sg.group_description }}</td>
                                            <td>
                                                <a class="btn btn-primary btn-xs" href="#EditServiceGroup" @click="editServiceGroup(sg)">
                                                    <i class="fa fa-edit blue"></i>
                                                    <span>Update</span>
                                                </a>
                                            </td>
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
                        <button type="button" class="btn btn-flat btn-primary mb-3" @click="openModal"><i class="ti-plus text-white"></i> Create New</button>
                    </div>
                    <!-- ./Row Button -->
                </div>
                <!-- ./ Card body -->
            </div>
            <!-- ./ Card -->
        </div>
        <!-- ./ Box -->
    <!-- Create ServiceModal -->
        <div class="modal fade" id="serviceGroupModal" tabindex="-1" role="dialog" aria-labelledby="serviceGroupModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Create Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateGroup() : createGroup()">
                <!-- <input type="hidden" name="_token" :value="csrf"> -->
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" v-model="form.group_code" class="form-control" name="group_code" :class="{ 'is-invalid': form.errors.has('group_code') }" placeholder="Group Code">
                        <has-error :form="form" field="group_code"></has-error>
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="form.group_description" class="form-control" name="group_description" :class="{ 'is-invalid': form.errors.has('group_description') }"  placeholder="Group Description">
                        <has-error :form="form" field="group_description"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-primary btn-flat">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary btn-flat">Save changes</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
$(document).ready(function() {
    $('#serviceGroupModal').on('shown.bs.modal', function (e) {
    // Show the backdrop
    //$('<div class="modal-backdrop"></div>').appendTo(document.body);
    $(document.body).addClass('modal-backdrop')
    })
    $('#serviceGroupModal').on('hidden.bs.modal', function (e) {
        // $(".modal-backdrop").remove();
        $(document.body).removeClass('modal-backdrop')
    })
})
export default {
    data() {
        return {
            editmode: false,
            serviceGroups: {},
            form: new Form({
                id: '',
                group_code: '',
                group_description: ''
            })
        }
    },
    methods: {
        datatable(){
            setTimeout(function(){
                let table = $('#service_group_table').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: true,
                });
            }, 900);
        },
        get_service_group(){
            axios.get("api/servicematrix/GetServices").then(({ data }) => (this.serviceGroups = data));
        },
        editServiceGroup(sg){
            this.form.clear()
            this.editmode = true;
            this.form.reset()
            $('#serviceGroupModal').modal('show')
            this.form.fill(sg)
        },
        updateGroup(){
            this.form.put('api/servicematrix/UpdateServiceGroup/'+this.form.id)
            .then((response) => {
                 $('#serviceGroupModal').modal('hide')
                $(document.body).removeAttr('class')
                $("#service_group_table").DataTable().destroy()
                this.get_service_group()
                this.datatable()
            })
            .catch(() => {
                console.clear()
            })
        },
        createGroup(){
            this.form.post('api/servicematrix/StoreServiceGroup')
            .then((response) => {
                $('#serviceGroupModal').modal('hide')
                $(document.body).removeAttr('class')
                $("#service_group_table").DataTable().destroy()
                this.get_service_group()
                this.datatable()
                
            })
            .catch(() => {
                console.clear()
            })
        },
        openModal(){
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#serviceGroupModal').modal('show');
        },
    },
    created() {
        this.datatable();
        this.get_service_group();
    }
}
</script>

<style>

</style>