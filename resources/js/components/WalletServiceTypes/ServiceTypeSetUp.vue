<template>
    <div>
        <div class="box col-md-8 offset-md-2 mt-3">
            <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--30 pt--30 mb-3">
                    <div class="icon icon-background"><i class="ti-pencil-alt"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                        <!-- content -->
                        <div class="card-body">
                            <div class="col-md-12">
                            <h4 class="header-title">List of Services using this service type</h4>
                            <hr>
                                    <div class="single-table">
                                    <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                    <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">Service Code</th>
                                        <th scope="col">Service Name</th>
                                        <th scope="col">Service Gateway</th>
                                    </tr>
                                    </thead>
                                    <tbody> 
                                    <tr v-for="Service in Services" :key="Service.id">
                                        <th scope="row">{{Service.service_code}}</th>
                                        <td>{{Service.service_name}}</td>
                                        <td>{{Service.gateway_name}}</td>
                                    </tr> 
                                    <tr v-if="this.Services.length === 0">
                                            <td colspan="3"> 
                                                No Services Available
                                            </td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                            </div> 
                            <!-- --> 
                                <div class="col-md-12 mt-3">
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="form-check custom-control custom-checkbox ">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="form.acknowledgement_template != null" disabled>
                                            <label class="form-check-label" for="exampleCheck1">Transaction Acknowledgement Template:  </label>
                                            <div class="custom-file">
                                            <input type="file" v-on:change="onFileChangeAcknowledgeTemplate" class="custom-file-input" id="inputGroupFile03">
                                            <label class="custom-file-label" for="inputGroupFile03" v-if="form.acknowledgement_template != null">{{form.acknowledgement_template}}</label> 
                                            <label class="custom-file-label" for="inputGroupFile03" v-else>Choose File</label>
                                            </div>   
                                        </div> 
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check custom-control custom-checkbox ">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="form.approval_template != null" disabled>
                                            <label class="form-check-label" for="exampleCheck1">Transaction Approval Template:</label>
                                            <div class="custom-file">
                                            <input type="file" v-on:change="onFileChangeApprovalTemplate" class="custom-file-input" id="inputGroupFile03">
                                            <label class="custom-file-label" for="inputGroupFile03" v-if="form.approval_template != null">{{form.approval_template}}</label> 
                                            <label class="custom-file-label" for="inputGroupFile03" v-else>Choose File</label>
                                            </div> 
                                        </div> 
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-check custom-control custom-checkbox ">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="form.confirmation_template != null" disabled>
                                            <label class="form-check-label" for="exampleCheck1">Transaction Confirmation Template</label>
                                        <div class="custom-file">
                                            <input type="file" v-on:change="onFileChangeConfirmationTemplate" class="custom-file-input" id="inputGroupFile03">
                                            <label class="custom-file-label" for="inputGroupFile03" v-if="form.confirmation_template != null">{{form.confirmation_template}}</label> 
                                            <label class="custom-file-label" for="inputGroupFile03" v-else>Choose File</label>
                                        </div> 
                                        </div> 
                                    </li>
                                    </ul> 
                                    <button type="button" class="btn btn-primary btn-lg mb-5 mt-3 float-right" v-on:click="saveServiceType"><i class="ti-save"></i>  Service Type</button>
                                </div> 
                        </div> 
                    </div>
                </div>
            </div>

            <div class="card">

            
            </div> 
            
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
        Services : {},
        showList: true,
        id: this.$route.params.id,
        ServiceTypeDetails : {},
        form : new Form({
                acknowledgement_template : null,
                approval_template: null,
                confirmation_template: null,
        }),
        /***
         * Variable container for updating templates
         */
        acknowledgement_template : null, 
        approval_template: null,
        confirmation_template: null,
    }
},
methods: {
    showServices(){
            axios.get('/api/service_type/showservices/' +this.id) 
            .then((response) => {
                this.Services = response.data;
                if(response.data.length > 0 ){
                    this.Services = response.data;
                    console.log('true');
                }
                else {   

                }
            })
            .catch(() => {

            })
    },  
    showServicesDetails() {
            axios.get('/api/service_type/behavior/'+this.id)
                .then(response => {
                    this.ServiceTypeDetails = response.data; 
                    this.form.acknowledgement_template = response.data['acknowledgement_template'];
                    this.form.approval_template = response.data['approval_template']; 
                    this.form.confirmation_template = response.data['confirmation_template']; 
                    /**
                     * Gets the names of uploaded files
                     */
                    this.acknowledgement_template = response.data['acknowledgement_template']; 
                    this.approval_template = response.data['approval_template']; 
                    this.confirmation_template = response.data['confirmation_template']; 
                    
                }) 
    }, 
    onFileChangeAcknowledgeTemplate(e){
            console.log(e.target.files[0]); 
            this.acknowledgement_template = e.target.files[0];  // for setting up the variables of templates
            this.form.acknowledgement_template = e.target.files[0]['name'];  // for displaying on the client side
    }, 
    onFileChangeApprovalTemplate(e){
            console.log(e.target.files[0]); 
            this.approval_template = e.target.files[0]; // for setting up the variables of templates
            this.form.approval_template = e.target.files[0]['name']; // for displaying on the client side
    },
    onFileChangeConfirmationTemplate(e){
            console.log(e.target.files[0]);  
            this.confirmation_template = e.target.files[0]; // for setting up the variables of templates
            this.form.confirmation_template = e.target.files[0]['name']; // for displaying on the client side
    },
    saveServiceType(){
        swal.fire({
            title: 'Are you sure you want to save?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0077B5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Save!'
        }).then((result) => {
            if(result.value) {
                let Formtwo = new FormData(); 
                Formtwo.append('file_acknowledgement_template', this.acknowledgement_template);
                Formtwo.append('file_approval_template', this.approval_template);
                Formtwo.append('file_confirmation_template', this.confirmation_template);  
                Formtwo.append('id', this.id); 
                axios.post('/api/service_type/updateservicetype/templates',Formtwo)
                .then((response) =>{
                    console.log(response.data); 
                    this.$router.push('/servicetypes');
                    toast.fire({
                        type: 'success',
                        title: 'Saved!'
                    })
                })
                .catch(() => {
                    //console.log("error");  
                })
            }
        });

    },

},
created() {
    this.showServices();
    this.showServicesDetails();
}
}
</script>

<style>

</style>