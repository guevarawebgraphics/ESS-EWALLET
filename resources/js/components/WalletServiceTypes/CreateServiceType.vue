<template>
  <div id="CreateWalletAccount">
      <!-- <h1>Create Wallet Accounts</h1> -->
      <form-wizard @on-complete="onComplete" title="Create Service Type" subtitle="Details" color="#0077B5">
        <wizard-step 
        slot-scope="props"
        slot="step"
        :tab="props.tab"
        :transition="props.transition"
        :index="props.index">
        </wizard-step>
        <tab-content title="Service Type Details" :before-change="validateTab">
         
            <div class="box col-md-8 offset-md-2">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--30 pt--30 mb-3">
                        <div class="icon icon-background"><i class="ti-pencil-alt"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                            <!-- content -->
                            <div class="card-body"> 
                                <div class="col-md-12">
                                <h4 class="header-title">Service Type Details</h4> 
                                <hr>
                                    <div class="form-group row"> 
                                        <div class="col-md-12">
                                            <label for="servicetype_code" class="form-label">Service Type Code:</label>
                                            <input type="number" class="form-control mb-2" :class="{ 'is-invalid': errors.has('servicetype_code') } " v-model="form.servicetype_code" id="servicetype_code" placeholder="Code"  v-validate="'required'" name="servicetype_code"> 
                                            <label class="alert text-danger bg-white" v-if="errors.has('servicetype_code')"> {{errors.first('servicetype_code')}} </label> 
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="servicetype_name" class="form-label">Service Type Name:</label>
                                            <input type="text" class="form-control mb-2" :class="{ 'is-invalid': errors.has('servicetype_name') } " id="servicetype_name" placeholder="Name" v-model="form.servicetype_name"  v-validate="'required'" name="servicetype_name"> 
                                            <label class="alert text-danger bg-white" v-if="errors.has('servicetype_name')"> {{errors.first('servicetype_name')}} </label> 
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="servicetype_description" class="form-label">Service Type Description:</label>
                                            <input type="text" class="form-control mb-2" :class="{ 'is-invalid': errors.has('servicetype_description') } " id="servicetype_description" placeholder="Description" v-model="form.servicetype_description"  v-validate="'required'"  name="servicetype_description">
                                            <label class="alert text-danger bg-white" v-if="errors.has('servicetype_description')"> {{errors.first('servicetype_description')}} </label> 
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-custom">

                </div>
            </div>
        </tab-content>
        <tab-content title="Behavior" :before-change="ValidateTabTwo">
            <div class="box col-md-8 offset-md-2">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--30 pt--30 mb-3">
                        <div class="icon icon-background"><i class="ti-pencil-alt"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                                <!-- content -->
                                <div class="card-body" >
                                    <div class="col-md-12">
                                        <h4 class="header-title">Behavior</h4>
                                        <ul class="list-group list-group-flush"> 
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_ssw_sdw" v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single source wallet, added to single destination wallet</label>
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_ssw_mdw" v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single source wallet, added to multiple destination wallets</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_msw_sdw" v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to single destination wallet</label>
                                                </div>
                                            </li> 
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_msw_mdw" v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to multiple destination wallets</label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_sdw_ssw" v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single destination wallets, deducted from single source wallet</label>
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_sdw_msw"  v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single destination wallet, deducted from multiple source wallets</label>
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_mdw_ssw"  v-model="form.behavior_value">
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from single source wallet</label>
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control">
                                                    <input type="radio" class="form-check-input" id="exampleCheck1"  value="deducted_mdw_msw" v-model="form.behavior_value"> 
                                                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets</label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                        </div>
                    </div>
                </div>
            </div>

<!-- 
            <div class="card shadow-custom">

            </div>  -->
        </tab-content>

        <tab-content title="Template">
            <div class="box col-md-8 offset-md-2">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--30 pt--30 mb-3">
                        <div class="icon icon-background"><i class="ti-files"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                                <!-- content -->
                                <div class="card-body">
                                    <div class="col-md-5">
                                        <h4 class="header-title">Template</h4>

                                    </div>
                                    <hr>
                                            <div class="col-md-12">
                                            <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                
                                                <div class="form-check custom-control custom-checkbox ">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="this.form.acknowledgement_template != 'empty'" disabled>
                                                    <label class="form-check-label" for="exampleCheck1">Transaction Acknowledgement Template:  </label>
                                                    <div class="custom-file">
                                                    <input type="file" v-on:change="onFileChangeAcknowledgeTemplate" class="custom-file-input" name="acknowledgement_template" id="inputGroupFile03">
                                                    <label class="custom-file-label" for="inputGroupFile03" v-if="this.form.acknowledgement_template == 'empty'">Choose File</label>
                                                    <label class="custom-file-label" for="inputGroupFile03" v-else>{{this.form.acknowledgement_template['name']}}</label>
                                                    </div>   
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control custom-checkbox ">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="this.form.approval_template != 'empty'" disabled>
                                                    <label class="form-check-label" for="exampleCheck1">Transaction Approval Template:</label>
                                                    <div class="custom-file">
                                                    <input type="file" v-on:change="onFileChangeApprovalTemplate" class="custom-file-input" id="inputGroupFile03">
                                                    <label class="custom-file-label" for="inputGroupFile03" v-if="this.form.approval_template == 'empty'">Choose File</label>
                                                    <label class="custom-file-label" for="inputGroupFile03" v-else>{{this.form.approval_template['name']}}</label>
                                                    </div> 
                                                </div> 
                                            </li>
                                            <li class="list-group-item">
                                                <div class="form-check custom-control custom-checkbox ">
                                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  :checked="this.form.confirmation_template != 'empty'" disabled>
                                                    <label class="form-check-label" for="exampleCheck1">Transaction Confirmation Template:</label>
                                                <div class="custom-file">
                                                    <input type="file"  v-on:change="onFileChangeConfirmationTemplate" class="custom-file-input" id="inputGroupFile03">
                                                    <label class="custom-file-label" for="inputGroupFile03" v-if="this.form.confirmation_template == 'empty'">Choose File</label>
                                                    <label class="custom-file-label" for="inputGroupFile03" v-else>{{this.form.confirmation_template['name']}}</label>
                                                </div> 
                                                </div> 
                                            </li>

                                            </ul> 
                                            <!--  <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-right btn-custom">Save Service Type</button> -->
                                            </div>     
                                </div> 
                        </div>
                    </div>
                </div>

            </div>
            <!-- <div class="card shadow-custom">

            </div>  
       -->
        </tab-content>   
        <template slot="footer" slot-scope="props">
            <div class="wizard-footer-left">
            <wizard-button v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Previous</wizard-button>
            </div>
            <div class="wizard-footer-right">
            <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()" :disabled="errors.items.length>0" class="wizard-footer-right" id="nextbtn" :style="props.fillButtonStyle">Next <span class="ti-arrow-right"></span></wizard-button>

            <wizard-button v-else @click.native="onComplete()" class="wizard-footer-right finish-button" :style="props.fillButtonStyle"><span class="ti-save"></span> {{props.isLastStep ? 'Save Service Type' : 'Next'}}  </wizard-button>
            </div>
        </template> 
        
    </form-wizard>
  </div>
</template>

<script>
export default {
    data() {
        return { 
        loadingWizard: false,
        tabtwo : true,
        form  : new Form({
            servicetype_code : null,
            servicetype_name : null,
            servicetype_description: null, 
            behavior_value : null,
         /*   added_ssw_sdw: 0,
            added_ssw_mdw: 0,
            added_msw_sdw: 0, 
            added_msw_mdw: 0,
            deducted_sdw_ssw: 0,
            deducted_sdw_msw: 0,
            deducted_mdw_ssw:0,
            deducted_mdw_msw:0,*/
            acknowledgement_template : 'empty',
            approval_template : 'empty',
            confirmation_template : 'empty',
        })
        }
    }, 
    methods: {
        validateTab:function() { 
        /**
        * Form Validation 
        */
            if(!this.form.servicetype_name && !this.form.servicetype_description && !this.servicetype_code){
                this.$validator.validateAll().then(result => {
                        if (result) {
                        return;
                        } 
                });
                return false;
            }
            else {
                return true;
            }     
        },  
        onComplete: function() { 
              swal.fire({
                title: 'Are you sure you want to save?',
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#0077B5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save!'
            }).then((result) => {
                if(result.value)
                {
                    /**
                    * For creating service type
                    */ 
                    let Formtwo = new FormData(); 
                    Formtwo.append('file_acknowledgement_template', this.form.acknowledgement_template);
                    Formtwo.append('file_approval_template', this.form.approval_template);
                    Formtwo.append('file_confirmation_template', this.form.confirmation_template); 
                    Formtwo.append('servicetype_code', this.form.servicetype_code);
                    Formtwo.append('servicetype_name', this.form.servicetype_name); 
                    Formtwo.append('behavior_value', this.form.behavior_value); 
                    Formtwo.append('servicetype_description', this.form.servicetype_description);

                    axios.post("/api/service_type/storeservicetype",Formtwo)
                    .then((response) =>{
                            this.$router.push('servicetypes') 
                            toast.fire({
                                type: 'success',
                                title: 'Saved!'
                            })
                            //console.log("hi");
                    })
                    .catch(() => {
                            //console.log("error");  
                })
                }
            })

        },
        addServiceTypeDetails(){

        /**
        * Form Validation 
        */
            this.$validator.validateAll().then((result)=> {
            if(result) {
                this.tabone = true;
            }
            else {
                this.tabone = false;

            }      
        }) 
        },
        nextTabTwo(){
            this.tabone == false; 
            $('.nextbtn').attr('disabled',true); 
        
        },
        
        IsDisabled(){
            if(errors.items.length>0)
            {
                return false;
            }
            else {
                return true;
            }
        },
        
        onFileChangeAcknowledgeTemplate(e){
            console.log(e.target.files[0]);
            this.form.acknowledgement_template = e.target.files[0];
        },
        onFileChangeApprovalTemplate(e){
            console.log(e.target.files[0]);
            this.form.approval_template = e.target.files[0];
        },
        onFileChangeConfirmationTemplate(e){
            console.log(e.target.files[0]); 
            this.form.confirmation_template = e.target.files[0];
        },
        ValidateTabTwo(){
                if(this.form.behavior_value == null) {

                   return false;
                }
                else {
                   return true;
                }
        }
         /***
     * These methods are for changing the value of the form data
     */
   /* added_ssw_sdw(changeValue){
        changeValue == 0 ? this.form.added_ssw_sdw = 1 : this.form.added_ssw_sdw = 0 
    }, 
    added_ssw_mdw(changeValue){
        changeValue == 0 ? this.form.added_ssw_mdw = 1 : this.form.added_ssw_mdw = 0 
    },
    added_msw_sdw(changeValue){
        changeValue == 0 ? this.form.added_msw_sdw = 1 : this.form.added_msw_sdw = 0 
    }, 
    added_msw_mdw(changeValue){
        changeValue == 0 ? this.form.added_msw_mdw = 1 : this.form.added_msw_mdw = 0 
    }, 
    deducted_sdw_ssw(changeValue){
        changeValue == 0 ? this.form.deducted_sdw_ssw = 1 : this.form.deducted_sdw_ssw = 0 
    },  
    deducted_sdw_msw(changeValue){
        changeValue == 0 ? this.form.deducted_sdw_msw = 1 : this.form.deducted_sdw_msw = 0 
    },   
    deducted_mdw_ssw(changeValue){
        changeValue == 0 ? this.form.deducted_mdw_ssw  = 1 : this.form.deducted_mdw_ssw  = 0 
    },    
    deducted_mdw_msw(changeValue){
        changeValue == 0 ? this.form.deducted_mdw_msw  = 1 : this.form.deducted_mdw_msw  = 0 
    },    
       */
    },


    created() {

    },
}
</script>

<style>

</style>