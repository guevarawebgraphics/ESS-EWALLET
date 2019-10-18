<template>
  <div id="CreateWalletAccount">
      <!-- <h1>Create Wallet Accounts</h1> -->
      <form-wizard @on-complete="onComplete" title="Create Service Type" subtitle="Details" color="#0077B5">
        <tab-content title="Service Type Details">
            <div class="box ptb--100">
                <div class="card shadow-custom">
                    <div class="card-body"> 
                    <div class="col-sm-12">
                    <h4 class="header-title">Service Type Details</h4> 
                        <div class="form-group row"> 
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Code:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Code">
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Name">
                        </div>
                        </div> 
                        <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description:</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Description">
                        </div>
                        </div>
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
                <ul class="list-group list-group-flush"> 
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single source wallet, added to single destination wallet</label>
                    </div> 
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single source wallet, added to multiple destination wallets</label>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to single destination wallet</label>
                    </div>
                </li> 
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to multiple destination wallets</label>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single destination wallets, deducted from single source wallet</label>
                    </div> 
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single destination wallet, deducted from multiple source wallets</label>
                    </div> 
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from single source wallet</label>
                    </div> 
                </li>
                <li class="list-group-item">
                    <div class="form-check custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
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
                        <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-right btn-custom">Save Service Type</button>
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
        return {
        loadingWizard: false,
         errorMsg: null,
         count: 0
        }
    },
    methods: {
        onComplete: function(){
            console.log('Setup Complete');
        }
    },

    created() {},
}
</script>

<style>

</style>