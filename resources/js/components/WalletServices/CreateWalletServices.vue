<template>
<div id="container">
<form>
  <form-wizard @on-complete="onComplete" title="Create Service" subtitle="Services" color="#3498db">
    <tab-content title="Service details" :before-change="firstValidate">
      <div class="col-12 mt-5">
          <div class="card shadow-custom">
              <div class="col-md-12"> 
                    <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up I )</h4>   
              </div>   
              <div class="card-body"> 
              <div class="data-tables datatable-dark">  
                <div class="form-group row">
                    <div class="col-sm-6">
                      <div class="form-group"> 
                        <h4 class="header-title mt-3">Service Details </h4>   
                        <label for="exampleInputEmail1">Available ONLY in Wallet Type:</label>
                    <!--   <select class="custom-select" v-model="form.wallet_type_id" name="wallet_type">
                        <option selected="selected" disabled>Select</option>
                        <option v-bind:value="wt.id" v-for="wt in WalletTypes" :key="wt.id">{{wt.wallet_account_type}} -- {{wt.wallet_type}}</option>
                        </select> --> 

                        <select class="custom-select" :class="{ 'is-invalid': errors.has('wallet_type') }" v-model="form.wallet_type" name="wallet_type"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <option selected="selected" disabled>Select</option>
                        <option value="prepaid"> Prepaid </option>
                        <option value="credit"> Credit </option> 
                        <option value="prepaid/credit"> Prepaid/Credit </option> 
                        <option value="admin"> Admin </option>
                        </select> 
                        <p class="alert text=danger" v-if="errors.has('wallet_type')"> {{errors.first('wallet_type')}} </p> 
                      </div>   
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Type Code:</label>
                        <input type="number" class="form-control" :class="{ 'is-invalid': errors.has('servicetype_code')}" v-on:change="showServiceTypeDetails" v-model="form.servicetype_code" aria-describedby="emailHelp" placeholder="Enter Service Type Code" name="servicetype_code"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <p class="alert text=danger" v-if="errors.has('servicetype_code')"> {{errors.first('servicetype_code')}} </p> 
                      </div>  
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Type Name:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('servicetype_name')}" aria-describedby="emailHelp" placeholder="Enter Service Type Name" v-model="form.servicetype_name" name="servicetype_name"  v-validate="'required'" readonly>
                        <p class="alert text=danger" v-if="errors.has('servicetype_name')"> {{errors.first('servicetype_name')}} </p>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Code:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('service_code')}" aria-describedby="emailHelp" placeholder="Enter Service Code" v-model="form.service_code" name="service_code"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <p class="alert text=danger" v-if="errors.has('service_code')"> {{errors.first('service_code')}} </p>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Name:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('service_name')}" aria-describedby="emailHelp" placeholder="Enter Service Name" v-model="form.service_name" name="service_name"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <p class="alert text=danger" v-if="errors.has('service_name')"> {{errors.first('service_name')}} </p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Description:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('service_description')}" aria-describedby="emailHelp" placeholder="Enter Service Description" v-model="form.service_description" name="service_description"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <p class="alert text=danger" v-if="errors.has('service_description')"> {{errors.first('service_description')}} </p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Gateway:</label>
                        <select class="custom-select" :class="{ 'is-invalid': errors.has('service_gateway')}" v-model="form.service_gateway"  name="service_gateway"  v-validate="'required'" :disabled="this.method_name == 'joint'"> 
                        <option disabled>Please select one</option>
                        <option v-bind:value="sg.id" v-for="sg in ServiceGateway" :key="sg.id">{{sg.gateway_name}}</option>
                        </select>
                        <p class="alert text=danger" v-if="errors.has('service_gateway')"> {{errors.first('service_gateway')}} </p>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Group:</label>
                        <select class="custom-select" :class="{ 'is-invalid': errors.has('service_group')}" v-model="form.service_group_id" name="service_group"  v-validate="'required'" :disabled="this.method_name == 'joint'"> 
                        <option disabled >Please select one</option>
                        <option v-bind:value="g.id" v-for="g in ServiceGroups" :key="g.id"> {{g.group_description}}</option>
                        </select>
                        <p class="alert text=danger" v-if="errors.has('service_group')"> {{errors.first('service_group')}} </p>
                      </div>
                    </div> 
                    <div class="col-sm-6"> 
                      <h4 class="header-title mt-3">Wallet Detailss </h4>   
                      <div class="form-group">
                        <label for="exampleInputEmail1">Principal Redeem Wallet Account No:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('pr_wallet_acc_no')}" v-on:change="showPRWallletAccountName" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account No:"  v-model="form.pr_wallet_acc_no" name="pr_wallet_acc_no"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                        <p class="alert text=danger" v-if="errors.has('pr_wallet_acc_no')"> {{errors.first('pr_wallet_acc_no')}} </p>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Principal Redeem Wallet Account Name:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('pr_wallet_acc_name')}" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account Name" v-model="form.pr_wallet_acc_name" name="pr_wallet_acc_name"  v-validate="'required'" readonly>
                        <p class="alert text=danger" v-if="errors.has('pr_wallet_acc_name')"> {{errors.first('pr_wallet_acc_name')}} </p>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Income Reddem Wallet Account No:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('ir_wallet_acc_no')}"  v-on:change="showIRWalletName" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account No"  v-model="form.ir_wallet_acc_no" name="ir_wallet_acc_no"  v-validate="'required'" :disabled="this.method_name == 'joint'">
                      <p class="alert text=danger" v-if="errors.has('ir_wallet_acc_no')"> {{errors.first('ir_wallet_acc_no')}} </p>
                      </div> 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Income Reddem Wallet Account Name:</label>
                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('ir_wallet_acc_name')}" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account Name" v-model="form.ir_wallet_acc_name" name="ir_wallet_acc_name" v-validate="'required'" readonly>
                        <p class="alert text=danger" v-if="errors.has('ir_wallet_acc_name')"> {{errors.first('ir_wallet_acc_name')}} </p>
                      </div> 
                          <!-- 
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Template</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Template"  v-model="form.service_template" name="service_template"  v-validate="'required'" >
                        <small id="emailHelp" class="form-text text-muted"></small>
                      </div>  
                          -->
                      <div class="form-group">
                        <label for="exampleInputEmail1">Service Template</label>
                        <div class="input-group">
                        <div class="custom-file"> 
                        <input type="file" class="custom-file-label" v-on:change="onFileChangeServiceTemplate" name="service_template" id="service_template" v-validate="'required'" :disabled="this.method_name == 'joint'" v-if="this.method_name == 'create'">
                                     <input type="file" class="custom-file-label" v-on:change="onFileChangeServiceTemplate" name="service_template" id="service_template" :disabled="this.method_name == 'joint'" v-else>
                        <label class="custom-file-label" for="service_template" v-if="this.service_template === 'empty'">Choose file</label>
                        <label class="custom-file-label" for="service_template" v-else>{{this.service_template}}</label> 
                     
                        </div>
                        </div> 
                        <p class="alert text=danger" v-if="errors.has('service_template') && method_name === 'create'"> {{errors.first('service_template')}} </p>
                      </div>
            
                    </div>
                </div>
             
              </div>
              </div>
          </div>
      </div>

    </tab-content>
    <tab-content title="Set up" :before-change="secondValidate">
        <div class="col-12 mt-5">
            <div class="card shadow-custom"> 
                <div class="col-md-12">   
                  <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up II )</h4>   
                </div>   
                <div class="card-body"> 
                        
                  <div class="data-tables datatable-dark"> 
                  <table class="table table-hover"> 
                  <thead>
                      <tr class="th-table">
                          <th>Value</th>
                          <th>Source Wallet</th>
                          <th>Destination Wallet</th>
                          <th>Rates Table</th>
                      </tr>  
                  </thead>
                  <tbody> 
                      <tr v-for="sd in sd_values" :key="sd.id"> 
                          <td> {{sd.service_value}}</td>
                          <td> {{sd.service_source_wallet}}</td>
                          <td> {{sd.service_destination_wallet}}</td>
                          <td> {{sd.service_rate_table}}</td>
                      </tr>   
      
                  </tbody>
                  </table> 
                  <button type="button" class="btn btn-primary btn-custom" v-on:click="openModal()" :disabled="this.method_name == 'joint'">Create </button>

                  </div> 
                  <div class="col-md-12">      
                    <div class="row">
                    <div class="col-sm-6">    
                      <div class="custom-control custom-switch">  
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" v-on:click="switchApproval(form.approval)" :disabled="this.method_name == 'joint'">
                        <label class="custom-control-label" for="customSwitch1" v-if="this.form.approval == 0"> Require Approval : NO  </label>
                        <label class="custom-control-label" for="customSwitch1" v-else> Require Approval : YES  </label>
                      </div>   
                    </div> 
                    <div class="col-sm-6">
                      <div class="form-group">  
                        <label class="my-1" for="inlineFormCustomSelectPref">Assign Approver:</label>
                        <!--
                          <select class="custom-select my-1" id="assignapprover" :disabled="this.form.approval==0" v-model="this.form.merchant_admin_id"> 
                            <option value="0">Choose Merchant Admin</option>
                            <option value="1">Underconstruction</option>
                          </select>
                        --> 
                        <input type="text" :disabled="this.form.approval==0" v-model="this.form.merchant_admin_id" class="form-control" name="rates_table" placeholder="*Underconstruction">
                    </div>   
                    </div> 
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </tab-content>
    <tab-content title="Last step">
        <div class="col-12 mt-5">
            <div class="card shadow-custom">
                <div class="col-md-12"> 
                  <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up III )</h4>   
                </div>   
                <div class="card-body"> 
                      <h4 class="header-title">AMOUNT LIMITS</h4> 
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" >
                        <p class="text-muted mb-3">Amount limit (minimum and maximum) per transaction</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Minimum Amount : </label>
                              <div class="col-sm-9">
                                <input type="number" v-model="form.limit_minimum" class="form-control" placeholder="Enter Minimum Amount" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                              <div class="col-sm-9">
                                <input type="number" v-model="form.limit_maximum" class="form-control" placeholder="Enter Maximum Amount" :disabled="this.method_name == 'joint'"> 
                              </div>
                            </div>
                        </div>
                      </div> 
                      <!-- -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit of total transaction amount per day</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                              <div class="col-sm-9">
                                <input type="number" v-model="form.amount_per_day" class="form-control" placeholder="Enter Maximum Amount" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div> 
                      <!-- -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit of total transaction amount per month</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                              <div class="col-sm-9">
                                <input type="number" v-model="form.amount_per_month" class="form-control" placeholder="Enter Maximum Amount" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div> 
                      <!-- -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit of total transaction amount per year</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                              <div class="col-sm-9">
                                <input type="number"  v-model="form.amount_per_year"  class="form-control" placeholder="Enter Maximum Amount" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div> 
                      <!-- -->
                </div>
            </div>
        </div>
    </tab-content> 
    <tab-content title="Last step">
        <div class="col-12 mt-5">
            <div class="card shadow-custom">
                <div class="col-md-12"> 
                    <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up IV )</h4>   
                </div>   
                <div class="card-body">         
                      <h4 class="header-title">LIMIT NO. OF TRANSACTION</h4> 
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit no. of transactions per day</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                              <div class="col-sm-8">
                                <input type="number" v-model="form.limit_per_day" class="form-control" placeholder="Enter Maximum No. of Transactions" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div> 
                      <!---- -----> 
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit no. of transactions per month</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                              <div class="col-sm-8">
                                <input type="number" v-model="form.limit_per_month" class="form-control" placeholder="Enter Maximum No. of Transactions" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div>  
                      <!---- -----> 
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="">
                        <p class="text-muted mb-3">Limit no. of transactions per year</p>        
                      </div> 
                      <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                              <div class="col-sm-8">
                                <input type="number" v-model="form.limit_per_year" class="form-control" placeholder="Enter Maximum No. of Transactions" :disabled="this.method_name == 'joint'">
                              </div>
                            </div>
                        </div>
                      </div> 
                </div>
            </div>
        </div>
    </tab-content> 
  </form-wizard> 
</form>
 <!-- Create ServiceModal -->
        <div class="modal fade" id="serviceValueSDRates" tabindex="-1" role="dialog" aria-labelledby="serviceGatewayModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createSD()">
                <!-- <input type="hidden" name="_token" :value="csrf"> -->
                <div class="modal-body">
                    <div class="form-group">
                    <label class="col-form-label">Value</label>
                      <select class="custom-select" v-model="form.value">
                      <option selected="selected" disabled>Select Value</option>
                      <option value="principal">Principal</option>
                      <option value="servicefee">Service Fee</option>
                      <option value="interest">Interest</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="form.source_wallet" class="form-control" name="source_wallet" placeholder="Source Wallet" disabled>
                    </div> 
                    <div class="form-group">
                    <label class="col-form-label">Destination Wallet</label>
                      <select class="custom-select" v-model="form.destination_wallet">
                      <option selected="selected" disabled>Select Value</option>
                      <option value="Principal Redeem">Principal Redeem</option>
                      <option value="Income Redeem">Income Redeem</option>
                      </select>
                    </div>
                    <div class="form-group">
                        <input type="text" v-model="form.rates_table" class="form-control" name="rates_table" placeholder="Rates Table">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
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
    edit_mode : false,
    ServiceGateway : {},
    ServiceGroups :{},  
    sd_values : [], 
    get_service_id : this.$route.params.id, 
    method_name : this.$route.params.method_name,
   // WalletTypes : {},
    service_template : 'empty', 
    form : new Form({  
      /**
       *  Service ID for updating
       */
       service_id : '',
      /**
       * Form data For First Tab
       */ 
      /**
       * Service Condition
       */
      service_condition : 'solo',
      service_type_id :null,
      pr_wallet_id: null,
      ir_wallet_id:null, 
      wallet_type : null, 
     // wallet_type_id : null,
      servicetype_code : null,
      servicetype_name: null,
      service_code: null,
      service_name : null,
      service_description : null,
      service_gateway: null,
      pr_wallet_acc_no : null,
      pr_wallet_acc_name: null,
      ir_wallet_acc_no: null,
      ir_wallet_acc_name:null,
      service_group_id : null,
      service_template: 'empty', 
      /**
       * Form data for Second Tab
       */  
      approval : 0,
      merchant_admin_id : null, 
      value : null,
      source_wallet :  'Initiator Wallet',
      destination_wallet : null,
      rates_table : null,

      /**
       * Form data for Third Tab
       */
      limit_minimum : 0,
      limit_maximum : 0,
      amount_per_day : 0,
      amount_per_month : 0,
      amount_per_year : 0,
      /**
       * Form Data for Fourth Tab
       */
      limit_per_day :0,
      limit_per_month : 0,
      limit_per_year: 0,
    }),
  }
},
methods:{
      onComplete: function(){ 
        if(this.method_name == 'view' || this.method_name == 'create'){
          this.submitServices();
        }
        else { 
            /**
             * Creating Object for storing inside the local storage
             */
            var list_services = [];
            list_services = JSON.parse(localStorage.getItem('list_services')); 
            if(list_services.length != 2){
                list_services.push(
                {'service_id': this.get_service_id,
                'wallet_type' : this.form.wallet_type,
                'service_name' : this.form.service_name,
                'service_code' : this.form.service_code,
                'service_description' : this.form.service_description,
                });
                localStorage.setItem('list_services', JSON.stringify(list_services));
                this.$router.push('/createjointservice'); 
            }
            else { 
            /**
             * This will trigger once the user reached the tentative maximum number of jointing services which is 3 (Suggested by the Project Owner.)
             */
                toast.fire({
                    type: 'warning',
                    title: `Adding failed! You've reached the maximum limit! (3)`
                })  
                this.$router.push('/createjointservice');
            }
     
               
        }
        
     }, 
    submitServices(){
        /**
       * 
       */ 
        this.$Progress.start()
        let Formtwo = new FormData(); 
        Formtwo.append('service_condition', this.form.service_condition); 
        if(this.edit_mode === true) {
        
        Formtwo.append('service_id', this.get_service_id); 
        
        }
        /**
         * First Tab 
         */
        Formtwo.append('wallet_type', this.form.wallet_type); 
        Formtwo.append('service_type_id', this.form.service_type_id); 
        Formtwo.append('pr_wallet_id', this.form.pr_wallet_id);
        Formtwo.append('ir_wallet_id', this.form.ir_wallet_id); 
        Formtwo.append('servicetype_code', this.form.servicetype_code);
        Formtwo.append('servicetype_name', this.form.servicetype_name);
        Formtwo.append('service_code', this.form.service_code);  
        Formtwo.append('service_name', this.form.service_name);  
        Formtwo.append('service_description', this.form.service_description);  
        Formtwo.append('service_gateway', this.form.service_gateway); 
        Formtwo.append('pr_wallet_acc_no', this.form.pr_wallet_acc_no);  
        Formtwo.append('pr_wallet_acc_name', this.form.pr_wallet_acc_name);  
        Formtwo.append('ir_wallet_acc_no', this.form.ir_wallet_acc_no); 
        Formtwo.append('ir_wallet_acc_name', this.form.ir_wallet_acc_name); 
        Formtwo.append('service_group_id', this.form.service_group_id);  
        Formtwo.append('service_template', this.form.service_template);
        /**
         * Second Tab 
        */
        Formtwo.append('sd_values', JSON.stringify(this.sd_values));  
        Formtwo.append('approval', this.form.approval);
        Formtwo.append('merchant_admin_id', this.form.merchant_admin_id);     
        /**
         * Third Tab
        */ 
        Formtwo.append('limit_minimum', this.form.limit_minimum);    
        Formtwo.append('limit_maximum', this.form.limit_maximum);
        Formtwo.append('amount_per_day', this.form.amount_per_day);
        Formtwo.append('amount_per_month', this.form.amount_per_month);
        Formtwo.append('amount_per_year', this.form.amount_per_year);  
        /**
         * Fourth Tab
         */
        Formtwo.append('limit_per_day', this.form.limit_per_day);  
        Formtwo.append('limit_per_month', this.form.limit_per_month);    
        Formtwo.append('limit_per_year', this.form.limit_per_year);    
        
        //this.form.post('/api/service/createservice')  
        if(this.edit_mode === false){

                axios.post("/api/service/createservice",Formtwo)
                .then((response)=>{ 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    this.$router.push('/serviceslist/view') 
                          toast.fire({
                              type: 'success',
                              title: `Service Created Successfully`
                          })
                })
                .catch(()=>{
                  console.log('error'); 
                  this.$Progress.fail()
                })
        }
        else { 
                axios.post("/api/service/updateservice",Formtwo)
                .then((response)=>{ 
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    this.$router.push('/serviceslist/view') 
                        toast.fire({
                              type: 'success',
                              title: 'Service Updated Successfully'
                          })
                })
                .catch(()=>{
                  console.log('error'); 
                  this.$Progress.fail()
                })
              
        }

    },
    showDatatable(){
            setTimeout(function(){
                let table = $('#sdwalletsetup').DataTable({
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
    /**
     * For showing Service Type Details by its service type code
     */
     showServiceTypeDetails(){ 
      this.$Progress.start()
      axios.get('/api/service/getservicetype/'+ this.form.servicetype_code)
      .then(response => {
      this.$Progress.increase(10)
      this.$Progress.finish()
      this.form.servicetype_name = response.data['st_name'];  
      this.form.service_type_id = response.data['id'];
          if(response.data['st_name'] == undefined){
                  toast.fire({
                              type: 'info',
                              title: 'Service Code not found'
                          })
          }
      })
      .catch(() => {
      this.$Progress.fail()
      })

     }, 
     /**
      * For showing the owner name of the wallet principal account no
      */
     showPRWallletAccountName(){
       this.$Progress.start()
       axios.get('/api/service/getprwalletdetails/'+ this.form.pr_wallet_acc_no)
       .then(response => {
            this.$Progress.increase(10)
            this.$Progress.finish()
            this.form.pr_wallet_acc_name = response.data['wallet_account_name']; 
            this.form.pr_wallet_id = response.data['id'];
            if(response.data['wallet_account_name'] == undefined){
                     toast.fire({
                              type: 'info',
                              title: 'Principal Redeem Wallet No not found'
                          })
            }
       })
       .catch(() => {
        this.$Progress.fail()
        })
     },
     showIRWalletName(){
       this.$Progress.start()
       axios.get('/api/service/getirwalletdetails/'+ this.form.ir_wallet_acc_no)
       .then(response => { 
          this.$Progress.increase(10)
          this.$Progress.finish()
          this.form.ir_wallet_acc_name = response.data['wallet_account_name'];
          this.form.ir_wallet_id = response.data['id'];

       })
       .catch(() =>{
          this.$Progress.fail()
          console.log('err');
       })
     }, 
    /**
     * Gets the service gateway list from other module
     */
    getServiceGateway(){
            axios.get('/api/service_gateway/getservicegateway')
            .then((response) => {
                this.ServiceGateway = response.data;
            })
    },
    /**
     * Gets the service group list from other module
     */
    getServiceGroup(){
         axios.get("/api/servicematrix/GetAllService")
         .then(({ data }) => (
           this.ServiceGroups = data
         ));  
    },
    /**
     * Setting up the service template
     */
    onFileChangeServiceTemplate(e){
            console.log(e.target.files[0]);
            this.form.service_template = e.target.files[0];
            this.service_template = e.target.files[0]['name'];
    }, 
    /**
     * For changing the approval status
     */
    switchApproval(changeValue) {
             if(changeValue == 0){
                this.form.approval  = 1   
             }
             else {
                this.form.approval  = 0;  
             }
    }, 
    openModal(){
            $('#serviceValueSDRates').modal('show');
        },  
    /**
     * For creating an object in array 
     */
    createSD(){ 
          this.form.value == '';
          this.form.destination_wallet == ''; 
          this.form.rates_table == '';
          this.sd_values.push({
            'service_value' : this.form.value,
            'service_source_wallet' : this.form.source_wallet,
            'service_destination_wallet' : this.form.destination_wallet,
            'service_rate_table' : this.form.rates_table
          })  
            console.log(this.sd_values);
             $('#serviceValueSDRates').modal('hide');
    },
    determineServiceMethod(){
       if(this.get_service_id != undefined){
          this.edit_mode = true;
          this.form.service_id = this.get_service_id;
          console.log('update'); 
          this.retrieveServicesDetails();
       }
       else {
          console.log('create')
       }
    }, 
    /**
     * This will trigger if the method used was 'update' method 
     * It only shows the values retrieved using the service ID
     */
    retrieveServicesDetails(){
        axios.get('/api/service/getservicedetails/'+ this.form.service_id)
       .then(response => { 
            console.log(response.data);
            console.log(this.form.service_id);   
            /**
             * Services
             */
            this.form.service_code = response.data[0]['service_code'];
            this.form.service_name = response.data[0]['service_name'];
            this.form.service_description = response.data[0]['service_description']; 
            /**
             * Wallet Type
             */
            this.form.wallet_type = response.data[0]['s_wallet_type'];  
            /**
             * Wallet Details
             */
            this.form.pr_wallet_id = response.data[0]['pr_details_id'];
            this.form.ir_wallet_id = response.data[0]['ir_details_id'];
            /**
             *  Service Type
             */
            this.form.servicetype_code = response.data[0]['st_code']; 
            this.form.servicetype_name = response.data[0]['st_name'];  
            this.form.service_type_id = response.data[0]['service_type_id'];
            /**
             * Service Gateway 
             */
            this.form.service_gateway = response.data[0]['service_gateway_id'];
            this.form.service_group_id = response.data[0]['service_group_id']; 
            /**
             * Gets the details of PR/IR wallet Accounts based on their ID
             */
            this.getWalletAccountDetails(response.data[0]['pr_details_id'],'pr'); 
            this.getWalletAccountDetails(response.data[0]['ir_details_id'],'ir');
            /**
             * Service Template
             */
            this.service_template = response.data[0]['service_template']; 
            this.form.service_template = response.data[0]['service_template'];  
            /**
             * Values Source Destination Rates Table
             */
            this.getVSDR(this.form.service_id); 
            /**
             * Service Amount Limits
             */ 
            this.form.limit_minimum = response.data[0]['limit_minimum'];
            this.form.limit_maximum = response.data[0]['limit_maximum'];
            this.form.amount_per_day = response.data[0]['amount_per_day'];
            this.form.amount_per_month = response.data[0]['amount_per_month'];
            this.form.amount_per_year = response.data[0]['amount_per_year'];
            /**
             * Service Transaction Limits
             */ 
            this.form.limit_per_day = response.data[0]['limit_per_day'];
            this.form.limit_per_month = response.data[0]['limit_per_month'];
            this.form.limit_per_year = response.data[0]['limit_per_year'];
       })
       .catch(() =>{
          console.log('error');
       })
    },
    getWalletAccountDetails($id,$redeem){
          axios.get('/api/service/getwalletdetails/'+ $id)
          .then(response => {  
                if($redeem == 'pr'){
                   console.log(response.data); 
                   this.form.pr_wallet_acc_no = response.data[0]['wallet_account_no'];
                   this.form.pr_wallet_acc_name = response.data[0]['wallet_account_name'];
                }
                else {
                   console.log(response.data); 
                    this.form.ir_wallet_acc_no = response.data[0]['wallet_account_no'];
                   this.form.ir_wallet_acc_name = response.data[0]['wallet_account_name'];
                }
          })
          .catch(() =>{
              console.log('error');``
          })
    },
    /**
     * Setting up the values, source wallet, destination wallet, rates table to the DATA return Array variable.
     */
    getVSDR($service_id){
          axios.get('/api/service/getvsdr/'+ $service_id)
          .then(response => {  
              console.log('vsdr');
              console.log(response.data)
              this.sd_values = response.data;
               
          })
          .catch(() =>{
              console.log('error');
          })
    },
    /*
    showWalletTypes() {
                axios.get('api/walletaccount/GetAllWalletAccountType').then(({ data}) => (this.WalletTypes = data));
        }b  
    */ 
   firstValidate(){ 
        let Validate = this.$validator.validateAll().then((result)=> { 
            if(result) {
                console.log('no errors');
                return true; 
            }
            else {
                console.log('has errors');
                toast.fire({
                    type: 'info',
                    title: `Please fill required fields!`
                }) 
                return false;
            }      
        }); 
        return Validate;
   },
   secondValidate(){
     if(this.sd_values.length === 0){ 
              toast.fire({
                    type: 'info',
                    title: `Fill atleast ( 1 ) row in the table!`
                })  
       return false; 
      
     }
     else {
       return true;
     }
   }
},
created() {
    this.getServiceGateway();
    this.getServiceGroup(); 
   // this.showWalletTypes(); 
    this.showDatatable(); 
    this.determineServiceMethod();
}
}
</script>

<style>

</style>
