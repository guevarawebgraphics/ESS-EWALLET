<template>
    <div class="box col-md-12">
        <div class="col-12 mt-5">
            <div class="card shadow-custom">
                <div class="card-body">  
                <div class="col-md-12">
                    <h4 class="header-title mt-3 text-center">
                        Prepaid Service Gateway 
                    </h4>     
                    <hr>
                    <button type="button" class="btn btn-primary btn-xs float-left mb-3" @click="openModal">Create New <i class="ti-pencil-alt text-white"></i></button>
                    <div class="float-right">
                        <div class="search-box">
                            <form action="#">
                                <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <div class="data-tables datatable-dark">
                    <table class="table table-hover table-striped table-bordered text-center" id="table-service-gateway">
                    <thead>
                        <tr class="th-table">
                            <th>Gateway Code</th>
                            <th>Gateway Name</th>
                            <th>Action</th>
                        </tr>  
                    </thead>
                    <tbody>
                        <tr v-for="sw in ServiceGateway.data" :key="sw.id"> 
                            <td>{{sw.gateway_code}}</td> 
                            <td>{{sw.gateway_name}}</td>
                            <td>     
                                <a class="btn btn-primary btn-xs" href="#EditServiceGroup" @click="ShowServiceGateway(sw)">
                                    <i class="fa fa-edit blue"></i>
                                    <span>Update</span>
                                </a>
                            </td>   
                        </tr> 
                    </tbody>
                    </table> 
                    <div class="text-center" v-if="this.ServiceGateway.data == 0">
                        <label>No Results found</label>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer bg-white">
                        <!-- Pagination Length -->
                        <div class="float-left">
                            {{ (ServiceGateway.next_page_url == null && ServiceGateway.prev_page_url == null) ? '' : 'Total ' + ServiceGateway.to }}
                            {{ (ServiceGateway.next_page_url == null && ServiceGateway.prev_page_url == null) ? '' : 'of ' + ServiceGateway.total }}
                        </div>
                        <!-- Pagination -->
                        <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                        <pagination class="float-right mb-3" :data="ServiceGateway" @pagination-change-page="getResults">
                            <span slot="prev-nav"><i class="ti-angle-left"></i> Previous</span>
                            <span slot="next-nav">Next <i class="ti-angle-right"></i></span>
                        </pagination>
                        <!-- Pagination -->
                    </div>
                    <!-- ./ Card Footer -->
                    </div>
                </div>
                    <div class="form-group row">
                    </div>
                </div>
            </div>
        </div> 
        <!-- Create ServiceModal -->
        <div class="modal fade" id="serviceGatewayModal" tabindex="-1" role="dialog" aria-labelledby="serviceGatewayModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Create Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateGateway() : createGateway()">
                <!-- <input type="hidden" name="_token" :value="csrf"> -->
                <div class="modal-body">
                    <!-- <div class="form-group">
                        <input type="number" v-model="form.gateway_code" class="form-control"  :class="{ 'is-invalid': form.errors.has('gateway_code') }" name="gateway_code" placeholder="Service Gateway Code"> 
                        <has-error :form="form" field="gateway_code"></has-error>
                    </div> -->
                    <div class="form-group">
                        <label for="gateway_name">Gateway Name</label>
                        <input type="text" v-model="form.gateway_name"  :class="{ 'is-invalid': form.errors.has('gateway_name') }" id="gateway_name"  class="form-control" name="gateway_name" placeholder="Service Gateway Name">
                         <has-error :form="form" field="gateway_name"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-primary" id="updateServiceGateWay">
                        <i class="ti-save"></i>
                        Update
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="updateSpinner"></span>
                    </button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary" id="saveServiceGateWay">
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
export default {
data() {
    return{
        message: null,
        typing: null,
        debounce: null,
        editmode : false,
        ServiceGateway : {},
        form :new Form({
            id  : null,
            gateway_code : null,
            gateway_name: null

        })
    }
},
methods: {
        getResults(page = 1) {
            axios.get(`/api/service_gateway/getservicegateway?page=${page}`)
                .then(response => {
                    this.ServiceGateway = response.data;
                });
        },
        getServiceGateway(){
            axios.get('/api/service_gateway/getservicegateway')
            .then((response) => {
                this.ServiceGateway = response.data;
            })
        },
        datatable(){
        setTimeout(function(){
                let table = $('#table-service-gateway').DataTable({
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
            }, 1000);
        },
        openModal(){
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#serviceGatewayModal').modal('show');
        },
        createGateway(){  
                $('#saveServiceGateWay').attr('disabled', true)
                $('#btn-close').attr('disabled', true)
                $('#saveSpinner').removeAttr('hidden')
                this.$Progress.start()
                this.form.post('/api/service_gateway/createservicegateway')
                .then((response) => { 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    // /console.log("ho"); 
                    $('#serviceGatewayModal').modal('hide') 
                    $('#saveSpinner').attr('hidden', true)
                    $('#saveServiceGateWay').removeAttr('disabled')
                    $('#btn-close').removeAttr('disabled')
                    this.getServiceGateway()
                    toast.fire({
                        type: 'success',
                        title: 'Saved!'
                    })
                })
                .catch(()=> { 
                   console.clear()
                   this.$Progress.fail()
                   $('#saveSpinner').attr('hidden', true)
                   $('#saveServiceGateWay').removeAttr('disabled')
                   $('#btn-close').removeAttr('disabled')
                //    console.log("eerrrrr");  
                })
        },
        ShowServiceGateway(sw){
            $('#serviceGatewayModal').modal('show');
            this.editmode = true;
            this.form.reset();
            this.form.clear();
            this.form.fill(sw)
            // /console.log('hi');
    
        },
        updateGateway(){ 
           $('#updateServiceGateWay').attr('disabled', true)
           $('#btn-close').attr('disabled', true)
           $('#updateSpinner').removeAttr('hidden')
           this.$Progress.start()
           this.form.put('/api/service_gateway/updateservicegateway/'+this.form.id)
           .then((response) => { 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    $('#serviceGatewayModal').modal('hide');
                    $('#updateSpinner').attr('hidden', true)
                     $('#btn-close').removeAttr('disabled')
                    $('#updateServiceGateWay').removeAttr('disabled')
                    this.getServiceGateway();
                    toast.fire({
                        type: 'success',
                        title: 'Saved!'
                    })
           })
           .catch(()=> { 
               console.clear()
               this.$Progress.fail() 
                $('#updateSpinner').attr('hidden', true)
                 $('#btn-close').removeAttr('disabled')
                $('#updateServiceGateWay').removeAttr('disabled')
               //console.log('err');
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
                    axios.get(`/api/service_gateway/searchServiceGateway/${this.message}`)
                    .then(response => {
                        this.ServiceGateway = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.getServiceGateway()
                }
            }, 600)
        },
    },
    created(){
            //this.datatable();
            this.getServiceGateway();
    }
    }
</script>

<style>

</style>