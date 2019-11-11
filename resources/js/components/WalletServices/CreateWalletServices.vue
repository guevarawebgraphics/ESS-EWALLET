<template>
<div id="container">
<form-wizard   @on-complete="onComplete" title="Create Service" subtitle="Services" color="#3498db">
  <tab-content title="Service details">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12"> 
                  <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up I )</h4>   
            </div>   
            <div class="card-body"> 
       
            <div class="data-tables datatable-dark">  
              <form>  
              <div class="form-group row">
                   <div class="col-sm-6">
                 
                    <div class="form-group"> 
                      <h4 class="header-title mt-3">Service Details </h4>   
                      <label for="exampleInputEmail1">Avaible ONLY in Wallet Type:</label>
                      <select class="custom-select" v-model="form.wallet_type" name="wallet_type">
                      <option selected="selected" disabled>Select</option>
                      <option value="Prepaid">Prepaid</option>
                      <option value="Credit">Credit</option>
                      </select>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Type Code:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" v-on:change="showServiceTypeDetails" aria-describedby="emailHelp" placeholder="Enter Service Type Code" v-model="form.servicetype_code" name="servicetype_code"  v-validate="'required'">
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Type Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Type Name" v-model="form.servicetype_name" name="servicetype_name"  v-validate="'required'" disabled>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Code:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Code" v-model="form.service_code" name="service_code"  v-validate="'required'">
                      <small id="emailHelp" class="form-text text-muted" v-if="errors.has('service_code')"> {{errors.first('service_code')}}</small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Name" v-model="form.service_name" name="service_name"  v-validate="'required'">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Description:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Description" v-model="form.service_description" name="service_description"  v-validate="'required'">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Gateway:</label>
                      <select class="custom-select"  v-model="form.service_gateway" name="service_gateway"> 
                      <option disabled value="">Please select one</option>
                      <option v-bind:value="sg.id" v-for="sg in ServiceGateway" :key="sg.id">{{sg.gateway_name}}</option>
                      </select>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Group:</label>
                      <select class="custom-select"  v-model="form.service_group_id" name="service_gateway"> 
                      <option disabled value="">Please select one</option>
                      <option v-bind:value="g.id" v-for="g in ServiceGroups" :key="g.id"> {{g.group_description}}</option>
                      </select>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                   </div> 
                   <div class="col-sm-6"> 
                    <h4 class="header-title mt-3">Wallet Detailss </h4>   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Principal Redeem Wallet Account No:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" v-on:change="showPRWallletAccountName" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account No:"  v-model="form.pr_wallet_acc_no" name="pr_wallet_acc_no"  v-validate="'required'">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Principal Redeem Wallet Account Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account Name" v-model="form.pr_wallet_acc_name" name="pr_wallet_acc_name"  v-validate="'required'" disabled>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Income Reddem Wallet Account No:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" v-on:change="showIRWalletName" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account No"  v-model="form.ir_wallet_acc_no" name="ir_wallet_acc_no"  v-validate="'required'">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Income Reddem Wallet Account Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account Name" v-model="form.ir_wallet_acc_name" name="ir_wallet_acc_name" v-validate="'required'" disabled>
                      <small id="emailHelp" class="form-text text-muted"></small>
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
                      <input type="file" class="custom-file-input" id="inputGroupFile04">
                      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                      </div>
                      </div>
                    </div>
          
                   </div>
              </div>
              </form>
            </div>
            </div>
        </div>
    </div>

  </tab-content>
  <tab-content title="Set up">
      <div class="col-12 mt-5">
          <div class="card shadow-custom"> 
              <div class="col-md-12">   
                 <h4 class="header-title mt-3 text-center">{{this.form.service_name}} ( Service Set Up II )</h4>   
              </div>   
              <div class="card-body"> 

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
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Amount limit (minimum and maximum) per transaction</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Minimum Amount : </label>
                            <div class="col-sm-9">
                              <input type="number" v-model="form.limit_minimum" class="form-control" id="inputEmail3" placeholder="Enter Minimum Amount">
                            </div>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                            <div class="col-sm-9">
                              <input type="number" v-model="form.limit_maximum" class="form-control" id="inputEmail3" placeholder="Enter Maximum Amount">
                            </div>
                          </div>
                      </div>
                    </div> 
                    <!-- -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit of total transaction amount per day</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                            <div class="col-sm-9">
                              <input type="number" v-model="form.amount_per_day" class="form-control" id="inputEmail3" placeholder="Enter Maximum Amount">
                            </div>
                          </div>
                      </div>
                    </div> 
                    <!-- -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit of total transaction amount per month</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                            <div class="col-sm-9">
                              <input type="number" v-model="form.amount_per_month" class="form-control" id="inputEmail3" placeholder="Enter Maximum Amount">
                            </div>
                          </div>
                      </div>
                    </div> 
                    <!-- -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit of total transaction amount per year</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Maximum Amount : </label>
                            <div class="col-sm-9">
                              <input type="number"  v-model="form.amount_per_year"  class="form-control" id="inputEmail3" placeholder="Enter Maximum Amount">
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
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit no. of transactions per day</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                            <div class="col-sm-8">
                              <input type="number" v-model="form.limit_per_day" class="form-control" id="inputEmail3" placeholder="Enter Maximum No. of Transactions">
                            </div>
                          </div>
                      </div>
                    </div> 
                    <!---- -----> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit no. of transactions per month</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                            <div class="col-sm-8">
                              <input type="number" v-model="form.limit_per_month" class="form-control" id="inputEmail3" placeholder="Enter Maximum No. of Transactions">
                            </div>
                          </div>
                      </div>
                    </div>  
                    <!---- -----> 
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                       <p class="text-muted mb-3">Limit no. of transactions per year</p>        
                    </div> 
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                          <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Maximum No. of Transactions: </label>
                            <div class="col-sm-8">
                              <input type="number" v-model="form.limit_per_year" class="form-control" id="inputEmail3" placeholder="Enter Maximum No. of Transactions">
                            </div>
                          </div>
                      </div>
                    </div> 
              </div>
          </div>
      </div>
  </tab-content>
</form-wizard>
</div>  


</template>

<script>


export default {
data() {
  return{
    ServiceGateway : {},
    ServiceGroups :{}, 
    form : new Form({ 
      /**
       * Form data For First Tab
       */
      service_type_id :null,
      pr_wallet_id: null,
      ir_wallet_id:null,
      wallet_type : null,
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
      service_template: null,
      /**
       * Form data for Second Tab
       */ 
      /**
       * Form data for Third Tab
       */
      limit_minimum : null,
      limit_maximum : null,
      amount_per_day : null,
      amount_per_month : null,
      amount_per_year : null,
      /**
       * Form Data for Fourth Tab
       */
      limit_per_day :null,
      limit_per_month : null,
      limit_per_year: null,

    }),
  }
},
methods:{
     onComplete: function(){
       console.log('hi'); 
       this.form.post('/api/service/createservice')
        .then((response)=>{
            this.$router.push('serviceslist')
        })
        .catch(()=>{
          console.log('error');
        })
     },
     showServiceTypeDetails(){
      axios.get('/api/service/getservicetype/'+ this.form.servicetype_code)
      .then(response => {

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
      
      })

     },
     showPRWallletAccountName(){
       axios.get('/api/service/getprwalletdetails/'+ this.form.pr_wallet_acc_no)
       .then(response => {
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

       }

       )
       
     },
     showIRWalletName(){
       axios.get('/api/service/getirwalletdetails/'+ this.form.ir_wallet_acc_no)
       .then(response => { 
          this.form.ir_wallet_acc_name = response.data['wallet_account_name'];
          this.form.ir_wallet_id = response.data['id'];

       })
       .catch(() =>{
          console.log('err');
       })
     },  
     getServiceGateway(){
            axios.get('/api/service_gateway/getservicegateway')
            .then((response) => {
                this.ServiceGateway = response.data;
            })
    },
    getServiceGroup(){
         axios.get("/api/servicematrix/GetAllService")
         .then(({ data }) => (
           this.ServiceGroups = data
         ));  
    }, 
    
},
created() {
    this.getServiceGateway();
    this.getServiceGroup();
}
}
</script>

<style>

</style>