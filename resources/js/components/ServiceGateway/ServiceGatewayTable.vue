<template>
    <div id="container">
        <div class="col-12 mt-5">
            <div class="card shadow-custom">
                <div class="col-sm-12"> 
                    <h4 class="header-title mt-3">Prepaid Service Gateway </h4>   
                </div>    

                <div class="card-body">  
                <div class="col-md-6">
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-service-gateway">
                <thead>
                    <tr class="th-table">
                        <th>Gateway Code</th>
                        <th>Gateway Name</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>
                    <tr v-for="sw in ServiceGateway" :key="sw.id"> 
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

                </div>
                </div>
                    <div class="form-group row">
                        <button type="button" class="btn btn-flat btn-primary mb-3" @click="openModal"><i class="ti-plus text-white"></i> Create New</button>
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
                    <div class="form-group">
                        <input type="number" v-model="form.gateway_code" class="form-control"  :class="{ 'is-invalid': form.errors.has('gateway_code') }" name="gateway_code" placeholder="Service Gateway Code"> 
                        <has-error :form="form" field="gateway_code"></has-error>
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="form.gateway_name"  :class="{ 'is-invalid': form.errors.has('gateway_name') }"  class="form-control" name="gateway_name" placeholder="Service Gateway Name">
                         <has-error :form="form" field="gateway_name"></has-error>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-primary btn-flat">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary btn-flat">
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
        editmode : false,
        ServiceGateway : {},
        form :new Form({
            id  : null,
            gateway_code : null,
            gateway_name: null

        })
    }
},
methods : {
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
            }, 500);
        },
        openModal(){
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#serviceGatewayModal').modal('show');
        },
        createGateway(){  
                $('#saveSpinner').removeAttr('hidden')
                this.$Progress.start()
                this.form.post('/api/service_gateway/createservicegateway')
                .then((response) => { 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    console.log("ho"); 
                    $('#serviceGatewayModal').modal('hide') 
                    $('#saveSpinner').attr('hidden', true)
                    this.getServiceGateway()
                })
                .catch(()=> { 
                   this.$Progress.fail()
                   $('#saveSpinner').attr('hidden', true)
                   console.log("eerrrrr");  
                })
        },
        ShowServiceGateway(sw){
            $('#serviceGatewayModal').modal('show');
            this.editmode = true;
            this.form.reset();
            this.form.fill(sw)
           
    
        },
        updateGateway(){ 
           $('#saveSpinner').removeAttr('hidden')
           this.$Progress.start()
           this.form.put('/api/service_gateway/updateservicegateway/'+this.form.id)
           .then((response) => { 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    $('#serviceGatewayModal').modal('hide');
                    $('#saveSpinner').attr('hidden', true)
                    this.getServiceGateway();
           })
           .catch(()=> { 
                    this.$Progress.fail() 
                     $('#saveSpinner').attr('hidden', true)
                    console.log('err');
           })
        }
},
created(){
         this.datatable();
         this.getServiceGateway();
}
}
</script>

<style>

</style>