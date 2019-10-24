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
            <div class="box ptb--100">
                <div class="card shadow-custom">
                    <div class="card-body"> 
                    <div class="col-sm-12">
                    <h4 class="header-title">Service Type Details</h4> 
                        <form >
                        <div class="form-group row"> 
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Code:</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control mb-4 col-sm-4" v-model="form.servicetype_code" id="inputEmail3" placeholder="Code"  v-validate="'required'" name="servicetype_code"> 
                          <p class="alert text=danger" v-if="errors.has('servicetype_code')"> {{errors.first('servicetype_code')}} </p> 
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Name" v-model="form.servicetype_name"  v-validate="'required'" name="servicetype_name"> 
                             <p class="alert text=danger" v-if="errors.has('servicetype_name')"> {{errors.first('servicetype_name')}} </p> 
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Description" v-model="form.servicetype_description"  v-validate="'required'"  name="servicetype_description">
                           <p class="alert text=danger" v-if="errors.has('servicetype_description')"> {{errors.first('servicetype_description')}} </p> 
                        </div>
                        </div> 
        
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </tab-content>
        <tab-content title="Behavior">
            <div class="card shadow-custom">
            <div class="card-body" >
            <div class="col-sm-7">
            <h4 class="header-title">Behavior</h4>
         <form>
                  <ul class="list-group list-group-flush"> 
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox ">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" v-bind="form.added_ssw_sdw" v-on:click="added_ssw_sdw(form.added_ssw_sdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single source wallet, added to single destination wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" v-bind="form.added_ssw_mdw" v-on:click="added_ssw_mdw(form.added_ssw_mdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single source wallet, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" v-bind="form.added_msw_sdw" v-on:click="added_msw_sdw(form.added_msw_sdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to single destination wallet</label>
                </div>
            </li> 
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" v-bind="form.added_msw_mdw" v-on:click="added_msw_mdw(form.added_msw_mdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  v-bind="form.deducted_sdw_ssw" v-on:click="deducted_sdw_ssw(form.deducted_sdw_ssw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single destination wallets, deducted from single source wallet</label>
                </div> 
             </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" v-bind="form.deducted_sdw_msw" v-on:click="deducted_sdw_msw(form.deducted_sdw_msw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single destination wallet, deducted from multiple source wallets</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  v-bind="form.deducted_mdw_ssw"  v-on:click="deducted_mdw_ssw(form.deducted_mdw_ssw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from single source wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox"> 
                    <input type="checkbox" class="form-check-input" id="exampleCheck1"  v-on:click="deducted_mdw_msw(form.deducted_mdw_msw)"> 
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets</label>
                </div>
            </li>
            </ul>
        
            </form>
            </div>
            </div> 
            </div> 
        </tab-content>
        <tab-content title="Template">
            <div class="card shadow-custom">
            <div class="card-body">
            <div class="col-sm-5">
            <h4 class="header-title">List of Services using this service type</h4>
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
                        <tr>
                        <th scope="row">0001</th>
                        <td>Smart Unli</td>
                        <td>ECPay</td>
                        </tr>
                        
                        </tbody>
                        </table>
                        </div>
                    </div>
            </div> 
                    <div class="col-md-6 mt-5">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Acknowledgement Template:  </label>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                            </div>   
                        </div> 
                    </li>
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Approval Template:</label>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                            </div> 
                        </div> 
                    </li>
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Confirmation Template:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div> 
                        </div> 
                    </li>

                    </ul> 
                      <!--  <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-right btn-custom">Save Service Type</button> -->
                    </div>     
            </div> 
            </div> 
        </tab-content>   
        <template slot="footer" slot-scope="props">
            <div class="wizard-footer-left">
            <wizard-button v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Previous</wizard-button>
            </div>
            <div class="wizard-footer-right">
            <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()" :disabled="errors.items.length>0" v-on:click="nextTabTwo" class="wizard-footer-right" :style="props.fillButtonStyle">Next</wizard-button>

            <wizard-button v-else @click.native="onComplete()" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">{{props.isLastStep ? 'Save Service Type' : 'Next'}}</wizard-button>
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
        form  : new Form({
            servicetype_code : null,
            servicetype_name : null,
            servicetype_description: null,
            added_ssw_sdw: 0,
            added_ssw_mdw: 0,
            added_msw_sdw: 0, 
            added_msw_mdw: 0,
            deducted_sdw_ssw: 0,
            deducted_sdw_msw: 0,
            deducted_mdw_ssw:0,
            deducted_mdw_msw:0,
        })
        }
    }, 
    methods: {
        validateTab:function(){
            if(!this.form.servicetype_name && !this.form.servicetype_description && !this.servicetype_code){
                this.$validator.validateAll().then(result => {
                        if (result) {
                        alert("Form Submitted!");
                        return;
                        } 
                });
                return false;
            }
            else {
                return true;
            }     
        }, 
        onComplete: function(){
           this.form.post("/api/createservicetype")
           .then((response) =>{
               this.$router.push('servicetypes') 
           })
           .catch(() => {
             console.log("error");  
           })
        },
        addServiceTypeDetails(){
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
            this.tabone ==false;
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
         /***
     * These methods are for changing the value of the form data
     */
    added_ssw_sdw(changeValue){
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
   
    },

    created() {

    },
}
</script>

<style>

</style>