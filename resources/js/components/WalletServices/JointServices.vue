<template>
    <div class="box col-12 mt-5">
        <div class="single-report mb-xs-30">
            <div class="s-report-inner pr--30 pt--30 mb-3">
                <div class="icon icon-background"><i class="ti-pencil-alt"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                        <!-- content -->
                        <div class="card-body"> 
                            <h4 class="header-title mt-3 text-center">  Joint Services </h4>   
                            <hr>
                            <div class="data-tables datatable-dark">  
                            <form @submit.prevent="saveJointServices()">     
                            <div class="row">
                            <div class="col-sm-6">     
                                <h4 class="header-title mt-3">JOINT SERVICE </h4>  
                                <div class="form-group row">
                                        <label for="exampleInputEmail1">Available ONLY in Wallet Type:</label>
                                        <select class="custom-select" id="wallet_type" v-model="form.wallet_type" name="wallet_type" :class="{ 'is-invalid': form.errors.has('wallet_type') }">
                                        <option selected="selected" disabled>Select</option>
                                        <option value="prepaid"> Prepaid </option>
                                        <option value="credit"> Credit </option> 
                                        <option value="prepaid/credit"> Prepaid/Credit </option> 
                                        <option value="admin"> Admin </option>
                                        </select> 
                                        <has-error :form="form" field="wallet_type"></has-error>
                                </div> 
                                <div class="form-group row"> 
                                        <label for="service_code">Service Code:</label>
                                        <input type="number" id="service_code" class="form-control" :class="{ 'is-invalid': errors.has('service_code') }" :on-change="validate" v-validate="'required'" v-model="form.service_code" aria-describedby="emailHelp" placeholder="Enter Service Code" name="service_code" >
                                        <!-- <has-error :form="form" field="service_code"></has-error> -->
                                        <p class="text-danger mt-1 bg-white" v-if="errors.has('service_code')">{{errors.first('service_code')}}</p>
                                </div>   
                                <div class="form-group row"> 
                                        <label for="exampleInputEmail1">Service Name:</label>
                                        <input type="text" id="service_name" class="form-control" v-model="form.service_name" :on-change="validate" v-validate="'required'" aria-describedby="emailHelp" placeholder="Enter Service Name" name="service_name" :class="{ 'is-invalid': errors.has('service_name') }">
                                        <!-- <has-error :form="form" field="service_name"></has-error> -->
                                        <p class="text-danger mt-1 bg-white" v-if="errors.has('service_name')">{{errors.first('service_name')}}</p>
                                </div>  
                                <div class="form-group row"> 
                                        <label for="exampleInputEmail1">Service Description:</label>
                                        <input type="text" id="service_description" class="form-control" :on-change="validate" v-validate="'required'" v-model="form.service_description" aria-describedby="emailHelp" placeholder="Enter Service Description" name="service_description" :class="{ 'is-invalid': errors.has('service_description') }">
                                        <!-- <has-error :form="form" field="service_description"></has-error> -->
                                        <p class="text-danger mt-1 bg-white" v-if="errors.has('service_description')">{{errors.first('service_description')}}</p>
                                </div>  
                                <router-link :to="{ name: 'services-list', params: { method_name: 'joint' }}" class="btn btn-primary btn-lg mb-5 mt-3 float-left" @click.native="addService(method_name)" > <i class="ti-plus"></i> Add Service</router-link>  
                            <!--     <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-left btn-custom" v-else disabled>Add Service </button> -->
                                <button type="submit" class="btn btn-primary btn-lg mb-5 mt-3 float-right" > <i class="ti-save"></i> Save Joint Service</button>
                            </div>  
                            <div class="col-sm-6">    
                                <div class="data-tables datatable-dark"> 
                                <table class="table table-hover" id="jointservicestable"> 
                                <thead>
                                    <tr class="th-table">
                                        <th>Wallet Type</th>
                                        <th>Service Code</th>
                                        <th>Service Name</th>
                                        <th>Service Description</th>
                                    </tr>  
                                
                                </thead>
                                <tbody> 
                                    <tr v-for="js in form.joint_services" :key="js.id">
                                            <td> {{js.wallet_type}}</td>
                                            <td> {{js.service_code}}</td>
                                            <td> {{js.service_name}}</td>
                                            <td> {{js.service_description}}</td>
                                    </tr>
                                </tbody>
                                </table> 

                                </div> 
                            </div>
                            </div>
                        </form>
                        </div>
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
        method_name : 'joint', 
        form : new Form({
            wallet_type : window.localStorage.getItem('wallet_type'), 
            service_code :  window.localStorage.getItem('service_code'),
            service_name :window.localStorage.getItem('service_name'),
            service_description :window.localStorage.getItem('service_description'), 
            joint_services : null,
        }),
    }
},
methods : { 
    addService(method){  

            if(localStorage.getItem('list_services') == null || localStorage.getItem('list_services') == undefined){ 
                /**
                 * For creating localstorage object in array for joint services
                 */
                var joint_services = [];
                localStorage.setItem('list_services', JSON.stringify(joint_services));
            }
                /**
                 * Sets local storage variables for fields below
                 */
            window.localStorage.setItem('wallet_type',this.form.wallet_type || '');
            window.localStorage.setItem('service_code', this.form.service_code || ''); 
            window.localStorage.setItem('service_name', this.form.service_name || ''); 
            window.localStorage.setItem('service_description',this.form.service_description || '');  
            window.localStorage.setItem('method_name','joint');        
    },
    showDatatable(){
            setTimeout(function(){
                let table = $('#jointservicestable').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-4" i><"col-lg-4" p>><"clear">',
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
    saveJointServices(){   
        if(localStorage.getItem('list_services') === null || localStorage.getItem('list_services') === undefined || localStorage.getItem('list_services')  === '[]'){ 
                toast.fire({
                    type: 'warning',
                    title: 'Please choose service to join'
                }) 
                return false;
        }
        {
                swal.fire({
                title: 'Are you sure?',
                text: "Save Joint Services",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
                }).then((result) => {
                if (result.value) { 
                    this.validate()
                        /**
                         * Insert Joint Services
                         */
                        this.form.post('/api/service/storetJointServices')
                        .then((response) => {
                                console.log(response.data);  
                                                    /**
                                 * Clears the local storage variable for joining services
                                 */
                                localStorage.removeItem('wallet_type');
                                localStorage.removeItem('service_code');
                                localStorage.removeItem('service_name');
                                localStorage.removeItem('service_description');
                                localStorage.removeItem('list_services');   
                                /**
                                 * Clears the UI
                                 */
                                this.form.wallet_type = '';
                                this.form.service_code = ''; 
                                this.form.service_name = '';
                                this.form.service_description = '';

                                this.showJointServiceTable(); 
                                this.form.clear()
                                this.form.reset();
                                toast.fire({
                                    type: 'success',
                                    title: 'Successfully Jointed Services'
                                })
                                this.$router.push('/serviceslist/view')
                            })
                        .catch(()=> {
                            console.clear()
                            // console.log("eerrrrr");  
                        })        
     
                        
                    }
                })
        }   
    

    },
    showJointServiceTable(){ 
            /**
             * Setting up the stored localstorage data into an actual JS array
             */
            this.form.joint_services = JSON.parse(localStorage.getItem('list_services'));
    },
    validate(){
        let validate = this.$validator.validateAll().then(result => {
            if (result) {
                return;
            }
        })
        return validate;
    }
},
created () {
    this.showJointServiceTable();
    this.showDatatable(); 
  
}
}
</script>

<style>

</style>