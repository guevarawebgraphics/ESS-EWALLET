<template>
    <div id="putmoney">
    <!-- Box -->
        <div class="box ptb--100 col-md-6 offset-md-3">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--30 pt--30 mb-3">
                        <div class="icon icon-background"><i class="ti-pencil-alt"></i></div>
                            <div class="s-report-title d-flex justify-content-between">
                            <!-- content -->
                            <!-- Form -->
                                <form @submit.prevent="storePutMoney()">
                                    <!-- Card Body -->
                                        <div class="card-body">
                                            <h4 class="header-title mt-3 text-center">Put Money</h4>
                                            <hr>
                                            <!-- Row -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button type="button" class="btn btn-secondary btn-xs">View Transaction History</button>
                                                    <button type="button" class="btn btn-secondary btn-xs">Balance</button>
                                                    <button type="button" class="btn btn-secondary btn-xs">Ave. Daily Usage</button>
                                                </div>
                                            </div>
                                            <!-- ./ Row -->
                                            <!-- Row -->
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <!-- Prefund Amount-->
                                                        <div class="form-group row">
                                                            <label class="control-label custom-label" for="putMoneyAmount">Prefund Amount: </label>
                                                            <input type="number" class="form-control" :class="{ 'is-invalid': errors.has('putMoneyAmount') } " v-model="form.putMoneyAmount" name="putMoneyAmount" v-validate="'required'" id="putMoneyAmount" min="0">
                                                            <has-error :form="form" field="putMoneyAmount"></has-error>
                                                            <p class="text-danger bg-white" v-if="errors.has('putMoneyAmount')">{{errors.first('putMoneyAmount')}}</p>
                                                        </div>
                                                        <hr>
                                                        <!-- ./ Prefund Amount -->
                                                        <!-- Deposited To -->
                                                            <div class="form-group row mt-3">
                                                                <h5 class="control-label custom-label font-weight-bold" for="bankName">Deposited to:</h5>
                                                                    <!-- Name of Bank -->
                                                                        <label class="control-label custom-label mt-3" for="bankName">Name of Bank:</label>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('bankName') } " v-model="form.bankName" id="bankName" name="bankName" v-validate="'required'">
                                                                        <has-error :form="form" field="bankName"></has-error>
                                                                        <p class="text-danger bg-white" v-if="errors.has('bankName')">{{errors.first('bankName')}}</p>
                                                                    <!-- ./ Name of Bank -->
                                                                    <!-- Branch -->
                                                                        <label class="control-label custom-label mt-3" for="branch">Branch:</label>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('branch') } " v-model="form.branch" id="branch" name="branch" v-validate="'required'">
                                                                        <has-error :form="form" field="branch"></has-error>
                                                                        <p class="text-danger bg-white" v-if="errors.has('branch')">{{errors.first('branch')}}</p>
                                                                    <!-- ./ Branch -->
                                                                    <!-- Account Type -->
                                                                        <label class="control-label custom-label mt-3" for="accountType">Account Type:</label>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('accountType') } " v-model="form.accountType" id="accountType" name="accountType" v-validate="'required'">
                                                                        <has-error :form="form" field="accountType"></has-error>
                                                                        <p class="text-danger bg-white" v-if="errors.has('accountType')">{{errors.first('accountType')}}</p>
                                                                    <!-- ./ Account Type -->
                                                                    <!-- Account Name -->
                                                                        <label class="control-label custom-label mt-3" for="accountName">Account Name:</label>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('accountName') } " v-model="form.accountName" id="accountName" name="accountName" v-validate="'required'">
                                                                        <has-error :form="form" field="accountName"></has-error>
                                                                        <p class="text-danger bg-white" v-if="errors.has('accountName')">{{errors.first('accountName')}}</p>
                                                                    <!-- ./ Account Name -->
                                                                    <!-- Account No -->
                                                                        <label class="control-label custom-label mt-3" for="AccountNo">Account No</label>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid': errors.has('accountNo') } " v-model="form.accountNo" id="accountNo" name="accountNo" v-validate="'required'">
                                                                        <has-error :form="form" field="accountNo"></has-error>
                                                                        <p class="text-danger bg-white" v-if="errors.has('accountNo')">{{errors.first('accountNo')}}</p>
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
                                            <button type="submit" class="btn btn-primary float-right">
                                                <i class="ti-save"></i>
                                                Submit
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="submitSpinner"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- ./ Row button -->
                                </form>
                            <!-- ./ Form -->
                        </div>
                    </div>
                </div>
        </div>
    <!-- ./ Box -->        
    </div>
</template>

<script>
export default {
    data(){
        return {
            DepositSlipName: null,
            csrf_token: $('meta[name="csrf-token"]').attr('content'),
            form: new Form({
                putMoneyAmount: 0,
                bankName: '',
                branch: '',
                accountType: '',
                accountName: '',
                accountNo: '',
                depositSlip: '',
                walletId: '',
            })
        }
    },
    methods: {
        storePutMoney() {
            swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
            }).then((result) => {
                if(result.value) {
                    this.$Progress.start()
                    let validateform = this.$validator.validateAll().then(result => {
                        if (result) {
                            $('#submitSpinner').removeAttr('hidden')
                            let formData = new FormData();
                            formData.append('depositSlip', this.form.depositSlip)
                            formData.append('_token', this.csrf_token)
                            formData.append('put_money_amount', this.form.putMoneyAmount)
                            formData.append('bank_name', this.form.bankName)
                            formData.append('branch', this.form.branch)
                            formData.append('accountType', this.form.accountType)
                            formData.append('accountName', this.form.accountName)
                            formData.append('accountNo', this.form.accountNo)
                            formData.append('walletId', this.form.walletId)
                            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                            axios.post('/api/transaction/storePutMoney', formData, {
                                headers: {
                                    'Content-Type': 'multipart/form-data',
                                    'X-CSRF-TOKEN': this.csrf_token
                                }
                            })
                            .then(res => {
                                this.$Progress.increase(10)
                                this.$Progress.finish()
                                if (res) {
                                    toast.fire({
                                        type: 'success',
                                        title: 'Put Money Saved',
                                    })
                                    this.form.clear()
                                    this.form.reset()
                                    this.$validator.reset()
                                    this.DepositSlipName = null
                                }
                                $('#submitSpinner').attr('hidden', true)
                            })
                            .catch(err => {
                                this.$Progress.fail()
                                if(err.status === 422) {
                                    toast.fire({
                                        type: 'info',
                                        title: 'Deposit Slip is Required'
                                    })
                                    $('#submitSpinner').attr('hidden', true)
                                }
                            })
                        }
                        $('#submitSpinner').attr('hidden', true)
                        this.$Progress.fail()
                        return false;
                    })
                }
            })
        },
        uploadDepositSlip(e){
            e.preventDefault()
            this.form.depositSlip = this.$refs.file.files[0];
            this.DepositSlipName = e.target.files[0].name;
        }
    },
    created(){

    }
}
</script>

<style>

</style>