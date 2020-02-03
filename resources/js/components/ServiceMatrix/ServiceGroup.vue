<template>
    <div id="serviceGroup">
        <!-- Box -->
        <div class="box col-md-12 ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Row Table -->
                    <div class="form-group row">
                        <!-- Col lg 6 -->
                        <div class="col-md-12">
                            <div class="header-title text-center">Service Group</div>
                            <hr>
                            <button type="button" class="btn btn-primary btn-sm float-left mb-3" @click="openModal">Create New <i class="ti-pencil-alt text-white"></i></button>
                            <div class="float-right">
                                <div class="search-box">
                                    <form action="#">
                                        <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                                        <i class="ti-search"></i>
                                    </form>
                                </div>
                            </div>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table table-hover table-striped table-bordered text-center" id="service_group_table">
                                    <thead class="text-capitalize">
                                        <tr class="th-table">
                                            <th>Group Code</th>
                                            <th>Group Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="sg in serviceGroups.data" :key="sg.id">
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
                                <div class="text-center" v-if="this.serviceGroups.data == 0">
                                    <label>No Results found</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./ Row Table -->
                    <!-- Row Button -->
                    <div class="form-group row">
                    </div>
                    <!-- ./Row Button -->
                </div>
                <!-- ./ Card body -->
                <!-- Card Footer -->
                <div class="card-footer bg-white">
                    <!-- Pagination Length -->
                    <div class="float-left">
                        {{ (serviceGroups.next_page_url == null && serviceGroups.prev_page_url == null) ? '' : 'Total ' + serviceGroups.to }}
                        {{ (serviceGroups.next_page_url == null && serviceGroups.prev_page_url == null) ? '' : 'of ' + serviceGroups.total }}
                    </div>
                    <!-- Pagination -->
                    <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                    <pagination class="float-right mb-3" :data="serviceGroups" @pagination-change-page="getResults">
                        <span slot="prev-nav"><i class="ti-angle-left"></i> Previous</span>
                        <span slot="next-nav">Next <i class="ti-angle-right"></i></span>
                    </pagination>
                    <!-- Pagination -->
                </div>
                <!-- ./ Card Footer -->
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
                    <!-- <div class="form-group">
                        <input type="text" v-model="form.group_code" class="form-control" name="group_code" :class="{ 'is-invalid': form.errors.has('group_code') }" placeholder="Group Code">
                        <has-error :form="form" field="group_code"></has-error>
                    </div> -->
                    <div class="form-group">
                        <label for="group_description" :hidden="form.group_description == ''"> Group Description</label>
                        <input type="text" v-model="form.group_description" class="form-control" id="group_description" name="group_description" :class="{ 'is-invalid': form.errors.has('group_description') }"  placeholder="Group Description">
                        <has-error :form="form" field="group_description"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose"><i class="ti-close"></i> Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-primary" id="btnUpdate">
                        <i class="ti-save"></i>
                         Update
                         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="Spinner"></span>
                    </button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary" id="btnSave">
                        <i class="ti-save"></i> 
                         Save changes
                         <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="saveSpinner"></span>
                    </button>
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
            message: null,
            typing: null,
            debounce: null,
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
                    "order": [2, "desc"]
                });
            }, 1000);
        },
        getResults(page = 1) {
            axios.get(`/api/servicematrix/GetAllService?page=${page}`)
                .then(response => {
                    this.serviceGroups = response.data;
                });
        },
        get_service_group(){
            axios.get("api/servicematrix/GetAllService").then(({ data }) => (this.serviceGroups = data));  
           
        },
        editServiceGroup(sg){
            this.form.clear()
            this.editmode = true;
            this.form.reset()
            $('#serviceGroupModal').modal('show')
            this.form.fill(sg)
        },
        updateGroup(){
            $('#btnUpdate').attr('disabled', true)
            $('#modalClose').attr('disabled', true)
            $('#Spinner').removeAttr('hidden')
            this.$Progress.start()
            this.form.put('api/servicematrix/UpdateServiceGroup/'+this.form.id)
            .then((response) => {
                this.$Progress.increase(10)
                this.$Progress.finish()
                 $('#serviceGroupModal').modal('hide')
                $(document.body).removeAttr('class')
                //$("#service_group_table").DataTable().destroy()
                this.get_service_group()
                //this.datatable()
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#Spinner').attr('hidden', true)
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
            })
            .catch(() => {
                this.$Progress.fail()
                console.clear()
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#Spinner').attr('hidden', true)
            })
        },
        createGroup(){
            $('#btnSave').attr('disabled', true)
            $('#modalClose').attr('disabled', true)
            $('#saveSpinner').removeAttr('hidden')
            this.$Progress.start()
            this.form.post('api/servicematrix/StoreServiceGroup')
            .then((response) => {
                this.$Progress.increase(10)
                this.$Progress.finish()
                $('#serviceGroupModal').modal('hide')
                $(document.body).removeAttr('class')
                $("#service_group_table").DataTable().destroy()
                this.get_service_group()
                this.datatable()
                $('#btnSave').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#saveSpinner').attr('hidden', true)
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
                
            })
            .catch(() => {
                this.$Progress.fail()
                console.clear()
                $('#btnSave').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#saveSpinner').attr('hidden', true)
            })
        },
        openModal(){
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#serviceGroupModal').modal('show');
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
                    axios.get(`/api/servicematrix/searchServiceGroup/${this.message}`)
                    .then(response => {
                        this.serviceGroups = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.get_service_group()
                }
            }, 600)
        },
    },
    created() {
        this.get_service_group();
    }
}
</script>

<style>

</style>