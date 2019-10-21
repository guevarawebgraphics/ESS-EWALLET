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
                        <form @change="addServiceTypeDetails">
                        <div class="form-group row"> 
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Code:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Code">
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Name" v-model="stname"  v-validate="'min:5'" name="stname"> 
                             <p class="alert" v-if="errors.has('stname')"> {{errors.first('stname')}} </p> 
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Description" v-model="stdesc"  v-validate="'min:5'"  name="stdesc">
                           <p class="alert" v-if="errors.has('stdesc')"> {{errors.first('stdesc')}} </p> 
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
                <form action="#">
                <ul class="list-group list-group-flush"  v-for="behavior in behaviors" :key="behavior.id"> 
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">{{behavior.item}}</label>
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
                        <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-right btn-custom">Save Service Type</button>
                    </div>     
            </div> 
            </div> 
        </tab-content>   
        <template slot="footer" slot-scope="props">
            <div class="wizard-footer-left">
            <wizard-button v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Previous</wizard-button>
            </div>
            <div class="wizard-footer-right">
            <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">Next</wizard-button>

            <wizard-button v-else @click.native="alert('Done')" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">{{props.isLastStep ? 'Done' : 'Next'}}</wizard-button>
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
         tabone: false,
         stname :'',
         stdesc : '' ,
         behaviors :
            [
            {item :'Balance transfer initiated in single source wallet, added to single destination wallet'}, 
            {item :'Balance transfer intiated in single source wallet, added to multiple destination wallets'},
            {item :'Balance transfer initiated in multiple source wallets, added to single destination wallet'},
            {item :'Balance transfer initiated in multiple source wallets, added to multiple destination wallets'},
            {item :'Balance transfer initiated in multiple destination wallets, deducted from single source wallet'},
            {item :'Balance transfer initiated in single destination wallet, deducted from multiple source wallets'},
            {item :'Balance transfer initiated in multiple destination wallets, deducted from single source wallet'}, 
            {item :'Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets'}
            ]
        }
    }, 
    methods: {
        validateTab:function(){
            return this.tabone;
            this.tabone = false;
        }, 
        onComplete: function(){
            console.log('Setup Complete');
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
   
    },

    created() {


    },
}
</script>

<style>

</style>