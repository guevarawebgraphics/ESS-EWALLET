<template>
<div id="container">
<form-wizard   @on-complete="onComplete" title="Create Service" subtitle="Services" color="#3498db">
  <tab-content title="Service details">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
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
                      <option selected="selected" disabled>Select</option>
                      <option v-bind:value="sg.id" v-for="sg in ServiceGateway" :key="sg.id">{{sg.gateway_name}}</option>
                  
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
  <tab-content title="Additional Info">
   SOOOONNNN
   </tab-content>
   <tab-content title="Last step">
     SOOOONNNN
   </tab-content>
</form-wizard>
</div>  


</template>

<script>
export default {
data() {
  return{
    ServiceGateway : {},
    form : new Form({
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
    //  service_template: null,
      
    })
  }
},
methods:{
     onComplete: function(){
       console.log('hi'); 
       this.form.post('/api/createservice')
        .then((response)=>{
            this.$router.push('serviceslist')
        })
        .catch(()=>{
          console.log('error');
        })
     },
     showServiceTypeDetails(){
      axios.get('/api/getservicetype/'+ this.form.servicetype_code)
      .then(response => {

      this.form.servicetype_name = response.data['st_name'];  
      this.form.servicetype_id = response.data['id'];
      
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
       axios.get('/api/getprwalletdetails/'+ this.form.pr_wallet_acc_no)
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
       axios.get('/api/getirwalletdetails/'+ this.form.ir_wallet_acc_no)
       .then(response => { 
          this.form.ir_wallet_acc_name = response.data['wallet_account_name'];
          this.form.ir_wallet_id = response.data['id'];

       })
       .catch(() =>{
          console.log('err');
       })
     },  
     getServiceGateway(){
            axios.get('/api/getservicegateway')
            .then((response) => {
                this.ServiceGateway = response.data;
            })
    }
},
created() {
    this.getServiceGateway();
}
}
</script>

<style>

</style>