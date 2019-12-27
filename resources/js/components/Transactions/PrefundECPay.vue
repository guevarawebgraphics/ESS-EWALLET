<template>
    <div id="prefundEcPay">
        <!-- Box -->
            <div class="box ptb--100">
                <!-- Card -->
                    <div class="card shadow-custom">
                        <div class="col-md-12">
                            <h4 class="header-title mt-3 text-center">Prefund ECPay</h4>
                            <hr>
                        </div>
                        <!-- Form -->
                            <form @submit.prevent="submitPrefund()">
                                <!-- Card Body -->
                                    <div class="card-body">
                                        <!-- Row -->
                                        <div class="row">
                                            <div class="col-md-12 offset-md-4">
                                                <button class="btn btn-secondary">View Transaction History</button>
                                                <button class="btn btn-secondary">Balance</button>
                                                <button class="btn btn-secondary">Ave. Daily Usage</button>
                                            </div>
                                        </div>
                                        <!-- ./ Row -->
                                        <!-- Row -->
                                            <div class="row">
                                                <div class="col-md-4 offset-md-1">
                                                    <!-- Prefund Amount-->
                                                    <div class="form-group row">
                                                        <label class="control-label custom-label" for="prefundAmount">Prefund Amount: </label>
                                                        <input type="number" class="form-control" v-model="form.prefundAmount" name="prefundAmount" id="prefundAmount">
                                                    </div>
                                                    <hr>
                                                    <!-- ./ Prefund Amount -->
                                                    <!-- Deposited To -->
                                                        <div class="form-group row mt-3">
                                                            <h5 class="control-label custom-label font-weight-bold" for="nameofBank">Deposited to:</h5>
                                                                <!-- Name of Bank -->
                                                                    <label class="control-label custom-label mt-3" for="nameofBank">Name of Bank:</label>
                                                                    <input type="text" class="form-control" v-model="form.nameofbank" id="nameofBank" name="nameofBank">
                                                                <!-- ./ Name of Bank -->
                                                                <!-- Branch -->
                                                                    <label class="control-label custom-label mt-3" for="branch">Branch:</label>
                                                                    <input type="text" class="form-control" v-model="form.branch" id="branch" name="branch">
                                                                <!-- ./ Branch -->
                                                                <!-- Account Type -->
                                                                    <label class="control-label custom-label mt-3" for="accountType">Account Type:</label>
                                                                    <input type="text" class="form-control" v-model="form.accountType" id="accountType" name="accountType">
                                                                <!-- ./ Account Type -->
                                                                <!-- Account Name -->
                                                                    <label class="control-label custom-label mt-3" for="accountName">Account Name:</label>
                                                                    <input type="text" class="form-control" v-model="form.accountName" id="accountName" name="accountName">
                                                                <!-- ./ Account Name -->
                                                                <!-- Account No -->
                                                                    <label class="control-label custom-label mt-3" for="AccountNo">Account No</label>
                                                                    <input type="text" class="form-control" v-model="form.accountNo" id="accountNo" name="accountNo">
                                                                <!-- ./ Account No -->
                                                        </div>
                                                    <!-- ./ Deposited To -->
                                                    <!-- Deposit Slip -->
                                                    <div class="form-group row">
                                                        <div class="custom-file">
                                                            <input type="file" @change="uploadDepositSlip" class="custom-file-input" id="depositSlip" ref="file">
                                                            <label v-if="DepositSlipName == null" class="custom-file-label" for="depositSlip" id="depositSlip">Deposit Slip</label>
                                                            <label v-if="DepositSlipName != null" class="custom-file-label" for="depositSlip" id="depositSlip">{{ DepositSlipName }}</label>
                                                        </div>
                                                    </div>
                                                    <!-- ./ Deposit Slip -->
                                                </div>
                                            </div>
                                        <!-- ./ Row -->
                                    </div>
                                <!-- ./ Cardd Body -->
                                <!-- Row Button -->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-right"><i class="ti-save"></i> Submit</button>
                                    </div>
                                </div>
                                <!-- ./ Row button -->
                            </form>
                        <!-- ./ Form -->
                    </div>
                <!-- ./ Card -->
            </div>
        <!-- ./ Box -->
    </div>
</template>

<script>
export default {
    data(){
        return{
            DepositSlipName: null,
            form: new Form({
                csrf_token: $('meta[name="csrf-token"]').attr('content'),
                prefundAmount: 0,
                nameofbank: null,
                branch: null,
                accountType: null,
                accountName: null,
                accountNo: null,
                depositSlip: null
            })
        }
    },
    methods: {
        submitPrefund(){
            swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
            }).then((result) => {
                if (result.value){
                    this.$Progress.start()
                    let formData = new FormData();
                    formData.append('depositSlip', this.form.depositSlip)
                    formData.append('_token', this.form.csrf_token)
                    formData.append('prefundAmount', this.form.prefundAmount)
                    formData.append('nameofbank', this.form.nameofbank)
                    formData.append('branch', this.form.branch)
                    formData.append('accountType', this.form.accountType)
                    formData.append('accountName', this.form.accountName)
                    formData.append('accountNo', this.form.accountNo)
                    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                    axios.post('/api/transaction/storeprefund ', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': this.csrf_token
                        }
                    })
                    .then(res => {
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    console.log(res)
                        if(res){
                            this.form.clear()
                            this.form.reset()
                        }
                        console.log(res)
                    })
                    .catch(err => {
                        this.$Progress.fail()
                        //console.log(err)
                        console.clear()
                    })
                }
            })
        },
        uploadDepositSlip(e){
            e.preventDefault()
            this.form.depositSlip = this.$refs.file.files[0];
            this.DepositSlipName = e.target.files[0].name;
            //return true;
        }
    },
    created(){
        console.log('Mounted')
    }
}
</script>

<style>

</style>