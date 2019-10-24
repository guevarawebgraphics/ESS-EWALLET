<template>
<div id="container">
<form-wizard   @on-complete="onComplete" title="Create Service" subtitle="Services" color="#3498db">
  <tab-content title="Service details">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
           
            </div>   
            <div class="card-body"> 
                   <h4 class="header-title mt-3">Service Detailss </h4>   
            <div class="data-tables datatable-dark">
                   <div class="col-sm-5">
                   <form>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Avaible ONLY in Wallet Type:</label>
                      <select class="custom-select" v-model="form.wallet_type">
                      <option selected="selected" disabled>Select</option>
                      <option value="Prepaid">Prepaid</option>
                      <option value="Credit">Credit</option>
                      </select>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Code:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Type Code" v-model="form.service_code">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Type Name" v-model="form.service_name">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Description:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Description" v-model="form.service_description">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Gateway:</label>
                      <select class="custom-select"  v-model="form.service_gateway">
                      <option selected="selected" disabled>Select</option>
                      <option value="EC Pay">EC Pay</option>
                      <option value="Credit">Credit</option>
                      </select>
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Principal Redeem Wallet Account No:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account No:"  v-model="form.pr_wallet_acc_no">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Principal Redeem Wallet Account Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Principal Redeem Wallet Account Name" v-model="form.pr_wallet_acc_name">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Income Reddem Wallet Account No:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account No"  v-model="form.ir_wallet_acc_no">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Income Reddem Wallet Account Name:</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Income Reddem Wallet Account Name" v-model="form.ir_wallet_acc_name">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div> 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Service Template</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Service Template" v-model="form.service_template">
                      <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                  </form>
                   </div>
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
    form : new Form({
      wallet_type : null,
      service_code: null,
      service_name : null,
      service_description : null,
      service_gateway: null,
      pr_wallet_acc_no : null,
      pr_wallet_acc_name: null,
      ir_wallet_acc_no: null,
      ir_wallet_acc_name:null,
      service_template: null,
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

}
}
</script>

<style>

</style>