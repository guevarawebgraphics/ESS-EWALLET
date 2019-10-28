<template>
  <div id="CreateWalletAccount">
      <!-- Create Wallet Account Form -->
     <form>
      <!-- Create Wallet Accounts Form Wizard -->
        <form-wizard @on-complete="onComplete" title="Create Wallet Account" subtitle="Details" color="#0077B5">
            <!-- Form Wizard Step -->
            <wizard-step 
                slot-scope="props"
                slot="step"
                :tab="props.tab"
                :transition="props.transition"
                :index="props.index">
            </wizard-step>
            <!-- E-Wallet Account Information (KYC) -->
            <tab-content title="E-Wallet Account Information (KYC)" :before-change="ValidateFirstStep">
                <div class="box">
                    <div class="card shadow-custom">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <!-- <hr> -->
                                    <!-- ESSID Username -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="username">ESSID/Username</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('username') } " v-on:change="SearchESSID"  name="username" v-validate="'required'" type="text" v-model="form.username" placeholder="ESSID/Username">
                                        <has-error :form="form" field="username"></has-error>
                                        <p class="text-danger" v-if="errors.has('username')">{{errors.first('username')}}</p>
                                    </div>
                                    <!-- Lastname -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="lastname">Lastname</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('lastname') }" name="lastname" v-validate="'required'" v-model="form.lastname" type="text" placeholder="Lastname" disabled>
                                        <has-error :form="form" field="lastname"></has-error>
                                        <p class="text-danger" v-if="errors.has('lastname')">{{errors.first('lastname')}}</p>
                                    </div>
                                    <!-- Firstname -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="firstname">Firstname</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('firstname') }" name="firstname" v-validate="'required'" v-model="form.firstname" type="text" placeholder="Firstname" disabled>
                                        <has-error :form="form" field="firstname"></has-error>
                                        <p class="text-danger" v-if="errors.has('firstname')">{{errors.first('firstname')}}</p>
                                    </div>
                                    <!-- Middlename -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="middlename">Middlename</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('middlename') }" name="middlename" v-validate="'required'" v-model="form.middlename" type="text" placeholder="Middlename" disabled>
                                        <has-error :form="form" field="middlename"></has-error>
                                        <p class="text-danger" v-if="errors.has('middlename')">{{errors.first('middlename')}}</p>
                                    </div>
                                    <!-- Present Address -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="presentaddress">Present Address</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('presentaddress') }" name="presentaddress" v-validate="'required'" v-model="form.presentaddress" type="text" placeholder="Present Address" disabled>
                                        <has-error :form="form" field="presentaddress"></has-error>
                                        <p class="text-danger" v-if="errors.has('presentaddress')">{{errors.first('presentaddress')}}</p>
                                    </div>
                                    <!-- Permanent Address -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="permanentaddress">Permanent Address</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('permanentaddress') }" name="permanentaddress" v-validate="'required'" v-model="form.permanentaddress" type="text" placeholder="Permanent Address" disabled>
                                        <has-error :form="form" field="permanentaddress"></has-error>
                                        <p class="text-danger" v-if="errors.has('permanentaddress')">{{errors.first('permanentaddress')}}</p>
                                    </div>
                                    <h6>Upload Documents</h6>
                                    <hr>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02">Filled-Up KYC Form</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile02">Valid ID w/ Signature</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <!-- <hr> -->
                                    <!-- Date of Birth -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="birthdate">Birthdate</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('birthdate') }" name="birthdate" v-validate="'required'" v-model="form.birthdate" type="text" placeholder="Birthdate" disabled>
                                        <has-error :form="form" field="birthdate"></has-error>
                                        <p class="text-danger" v-if="errors.has('birthdate')">{{errors.first('birthdate')}}</p>
                                    </div>
                                    <!-- Place of Birth -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="placeofbirth">Place of Birth</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('placeofbirth') }" name="placeofbirth" v-validate="'required'" v-model="form.placeofbirth" type="text" placeholder="Place of Birthdate" disabled>
                                        <has-error :form="form" field="birthdate"></has-error>
                                        <p class="text-danger" v-if="errors.has('placeofbirth')">{{errors.first('placeofbirth')}}</p>
                                    </div>
                                    <!-- Nationality -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="nationality">Nationality</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('nationality') }" name="nationality" v-validate="'required'" v-model="form.nationality" type="text" placeholder="Nationality" disabled>
                                        <has-error :form="form" field="nationality"></has-error>
                                        <p class="text-danger" v-if="errors.has('nationality')">{{errors.first('nationality')}}</p>
                                    </div>
                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="emailaddress">Email Address</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('emailaddress') }" name="emailaddress" v-validate="'required'" v-model="form.emailaddress" type="text" placeholder="Email Address" disabled>
                                        <has-error :form="form" field="emailaddress"></has-error>
                                        <p class="text-danger" v-if="errors.has('emailaddress')">{{errors.first('emailaddress')}}</p>
                                    </div>
                                    <h6>Goverment Numbers</h6>
                                    <hr>
                                    <!-- Tin -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="tin">Tin</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('tin') }" name="tin" v-validate="'required'" v-model="form.tin" type="text" placeholder="Tin" disabled>
                                        <has-error :form="form" field="tin"></has-error>
                                        <p class="text-danger" v-if="errors.has('tin')">{{errors.first('tin')}}</p>
                                    </div>
                                    <!-- SSSS -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="sss">SSS</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('sss') }" name="sss" v-validate="'required'" v-model="form.sss" type="text" placeholder="SSS" disabled>
                                        <has-error :form="form" field="sss"></has-error>
                                        <p class="text-danger" v-if="errors.has('sss')">{{errors.first('sss')}}</p>
                                    </div>
                                    <!-- National Id No -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="NationalIdNo">National Id No</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('NationalIdNo') }" name="NationalIdNo" v-validate="'required'" v-model="form.NationalIdNo" type="text" placeholder="National Id No" disabled>
                                        <has-error :form="form" field="sss"></has-error>
                                        <p class="text-danger" v-if="errors.has('NationalIdNo')">{{errors.first('NationalIdNo')}}</p>
                                    </div>
                                    <!-- Employer Name -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="EmployerName">Employer Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('EmployerName') }" name="EmployerName" v-validate="'required'" v-model="form.EmployerName" type="text" placeholder="Employer Name" disabled>
                                        <has-error :form="form" field="EmployerName"></has-error>
                                        <p class="text-danger" v-if="errors.has('EmployerName')">{{errors.first('EmployerName')}}</p>
                                    </div>
                                    <!-- Business Name -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="BusinessName">Business Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('BusinessName') }" name="BusinessName" v-validate="'required'" v-model="form.BusinessName" type="text" placeholder="Business Name" disabled>
                                        <has-error :form="form" field="BusinessName"></has-error>
                                        <p class="text-danger" v-if="errors.has('BusinessName')">{{errors.first('BusinessName')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ End E-Wallet Account Information (KYC)  -->
            <!-- E-Wallet Account Setup Step 2 -->
            <tab-content title="E-Wallet Acount Setup">
                <!-- Create Wallet Account Step 2 -->
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <hr>
                                    <!-- ESSID/Username -->
                                        <div class="form-group">
                                        <input class="form-control" v-model="form.username"  type="text" placeholder="ESSID/Username" disabled>
                                        </div>
                                        <hr>
                                        <h4>Wallet Details</h4>
                                        <!-- Wallet Type -->
                                        <div class="form-group mt-3">
                                            <label class="control-label custom-label" for="WalletType">Wallet Type</label>
                                            <select class="custom-select" :class="{ 'is-invalid': errors.has('WalletType') } "  name="WalletType" v-validate="'required'" v-model="form.WalletType">
                                                <option value="" selected disabled>Select</option>
                                                <option>Prepaid</option>
                                                <option>Select 1</option>
                                            </select>
                                            <has-error :form="form" field="WalletType"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletType')">{{errors.first('WalletType')}}</p>
                                        </div>
                                        <!-- Wallet Account Type -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountType">Wallet Account Type</label>
                                            <select class="custom-select" :class="{ 'is-invalid': errors.has('WalletAccountType') } "  name="WalletAccountType" v-validate="'required'"  v-model="form.WalletAccountType">
                                                <option value="" selected disabled>Select</option>
                                                <option>Prepaid Merchant</option>
                                                <option>Select 1</option>
                                            </select>
                                            <has-error :form="form" field="WalletAccountType"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountType')">{{errors.first('WalletAccountType')}}</p>
                                        </div>
                                        <!-- Wallet Account No -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountNo">Wallet Account No</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountNo') } "  name="WalletAccountNo" v-validate="'required'" type="text" v-model="form.WalletAccountNo" placeholder="WalletAccountNo" disabled="disabled">
                                            <has-error :form="form" field="WalletAccountNo"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountNo')">{{errors.first('WalletAccountNo')}}</p>
                                        </div>
                                        <!-- Wallet Account Name -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountName">Wallet Account Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountName') } "  name="WalletAccountName" v-validate="'required'" type="text" v-model="form.WalletAccountName" placeholder="WalletAccountName" disabled="disabled">
                                            <has-error :form="form" field="WalletAccountName"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountName')">{{errors.first('WalletAccountName')}}</p>
                                        </div>
                                        <!-- Wallet Title -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="Wallettitle">Wallet Title</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('Wallettitle') } "  name="Wallettitle" v-validate="'required'" type="text" v-model="form.Wallettitle" placeholder="Wallet Title">
                                            <has-error :form="form" field="Wallettitle"></has-error>
                                            <p class="text-danger" v-if="errors.has('Wallettitle')">{{errors.first('Wallettitle')}}</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ E-Wallet Account Setup Step 2 -->
            <!-- E-Wallet Account Setup Step 3-->
            <tab-content title="E-Wallet Acount Setup">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <!-- Account Name -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountName">Wallet Account Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountName') } "  name="WalletAccountName" v-validate="'required'" type="text" v-model="form.WalletAccountName" placeholder="WalletAccountName" disabled>
                                            <has-error :form="form" field="WalletAccountName"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountName')">{{errors.first('WalletAccountName')}}</p>
                                    </div>
                                    <!-- Account No -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountNo">Wallet Account No</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountNo') } "  name="WalletAccountNo" v-validate="'required'" type="text" v-model="form.WalletAccountNo" placeholder="WalletAccountNo" disabled>
                                            <has-error :form="form" field="WalletAccountNo"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountNo')">{{errors.first('WalletAccountNo')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </tab-content>
            <!--./ End E-Wallet Account Setup Step 3-->
            <!-- E-Wallet Account Setup Step 4 -->
            <tab-content title="E-Wallet Acount Setup">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <h5>Designated Bank Account/s:</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <!-- Name of Bank -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="NameOfBank">Name of Bank</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('NameOfBank') } "  name="NameOfBank" v-validate="'required'" type="text" v-model="form.NameOfBank" placeholder="Name Of Bank">
                                            <has-error :form="form" field="NameOfBank"></has-error>
                                            <p class="text-danger" v-if="errors.has('NameOfBank')">{{errors.first('NameOfBank')}}</p>
                                    </div>
                                    <!-- Branch -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="Branch">Branch</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('Branch') } "  name="Branch" v-validate="'required'" type="text" v-model="form.Branch" placeholder="Branch">
                                            <has-error :form="form" field="Branch"></has-error>
                                            <p class="text-danger" v-if="errors.has('Branch')">{{errors.first('Branch')}}</p>
                                    </div>
                                    <!-- Account Type -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletType">Wallet Type</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletType') } "  name="WalletType" v-validate="'required'" type="text" v-model="form.WalletType" placeholder="Account Type">
                                            <has-error :form="form" field="WalletType"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletType')">{{errors.first('WalletType')}}</p>
                                    </div>
                                    <!-- Account Name -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountName">Wallet Account Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountName') } "  name="WalletAccountName" v-validate="'required'" type="text" v-model="form.WalletAccountName" placeholder="Account Name">
                                            <has-error :form="form" field="WalletAccountName"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountName')">{{errors.first('WalletAccountName')}}</p>
                                    </div>
                                    <!-- Account No -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountNo">Wallet Account No</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountNo') } "  name="WalletAccountNo" v-validate="'required'" type="text" v-model="form.WalletAccountNo" placeholder="Account No">
                                            <has-error :form="form" field="WalletAccountNo"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountNo')">{{errors.first('WalletAccountNo')}}</p>
                                    </div>
                                    <div class="custom-control form-control-md custom-checkbox">
                                        <input type="checkbox" class="custom-control-input col-md-4" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
                                    </div>
                                    <!-- Add New Bank Account -->
                                    <!-- <button class="btn btn-primary btn-flat"> Add New Account</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ End E-Wallet Account Setup 4 -->
            <!-- E-Wallet Account Setup 5 -->
            <tab-content title="E-Wallet Acount Setup">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <h5>Amount Limits:</h5>
                            <hr>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- Form Wizzard Footer -->
            <template slot="footer" slot-scope="props">
                <div class="wizard-footer-left">
                <wizard-button  v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :disabled="errors.items.length>0" :style="props.fillButtonStyle">Previous</wizard-button>
                </div>
                <div class="wizard-footer-right">
                <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()" id="nextTab" :disabled="errors.items.length>0" class="wizard-footer-right" :style="props.fillButtonStyle">Next <span class="ti-arrow-right"></span></wizard-button>
                <wizard-button v-else @click.native="alert('Done')" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">  {{props.isLastStep ? 'Done' : 'Next'}} <span class="ti-saves"></span></wizard-button>
                </div>
            </template>
            <!-- ./ End Form Wizzard Footer Template -->
        </form-wizard>
    </form>
<!--./ End Wallet Form-->
  </div>
</template>

<script>
export default {
    data() {
        return {
         editmode: false,
         switching: false,
         step: 1,
         account: [],
         form: new Form({
           username: null,
           lastname: null,
           firstname: null,
           middlename: null,
           presentaddress: null,
           permanentaddress: null,
           birthdate: null,
           placeofbirth: null,
           nationality: null,
           contactNo: null,
           emailaddress: null,
           tin: null,
           sss: null,
           NationalIdNo: null,
           EmployerName: null,
           BusinessName: null,
           WalletType: null,
           WalletAccountType: null,
           WalletAccountNo: null,
           WalletAccountName: null,
           Wallettitle: null,
           NameOfBank: null,
           Branch: null,
        })
        }
    },
    methods: {
        onComplete: function(){
          alert('Yay. Done!');
        },
        ValidateFirstStep(){
            
            if(this.form.username != null){
                this.errors.clear()
                return true;
            }
            if(this.form.username == null){
                toast.fire({
                    type: 'info',
                    title: 'Please fill required fields'
                })
                this.$validator.validateAll().then(result => {
                    if (result) {
                    alert("Form Submitted!");
                    return;
                    }
                });
                return false;
            }
        },
        /**
         *@ Search For Account ESS ID 
         **/
        SearchESSID(){
            if(!this.form.username){
                $('#nextTab').attr('disabled', true)
            }
            else {
                axios.get('/api/account/' + this.form.username)
                .then(response => {
                    if(response.data.length > 0){
                        this.errors.clear()
                        $('#nextTab').removeAttr('disabled')
                        this.GenerateAccountNo()
                        this.account = response.data;
                        /**
                         * @ Fill Form 
                         **/
                        this.form.lastname = response.data[0]['lastname'];
                        this.form.firstname = response.data[0]['firstname'];
                        this.form.middlename = response.data[0]['middlename'];
                        this.form.emailaddress = response.data[0]['email_add'];
                        this.form.BusinessName = response.data[0]['accountname'];
                        this.form.EmployerName = response.data[0]['business_name'];
                        this.form.birthdate = response.data[0]['birthdate'];
                        this.form.WalletAccountName = response.data[0]['accountname'];
                        this.form.tin = response.data[0]['tin'];
                        this.form.sss = response.data[0]['sss'];
                        this.form.nationality = 'Filipino';
                        this.form.presentaddress = '#' + response.data[0]['address_unit'] + ' ' + response.data[0]['brgyDesc'] + ' ' + response.data[0]['citymunDesc'] + ' ' + response.data[0]['provDesc'];
                        this.form.permanentaddress = '#' + response.data[0]['address_unit'] + ' ' + response.data[0]['brgyDesc'] + ' ' + response.data[0]['citymunDesc'] + ' ' + response.data[0]['provDesc'];
                    }
                    else {
                        this.form.reset()
                        $('#nextTab').attr('disabled', true)
                        toast.fire({
                            type: 'info',
                            title: 'ESSID/Username not found'
                        })
                    }
                    
                })
                .catch(() => {
                    
                });
            }
        },
        /**
         * @ Generate Account No 
         **/ 
        GenerateAccountNo(){
            axios.get('/api/GenerateAccountNo')
            .then(response => {
                this.form.WalletAccountNo = response.data
            })
            .catch(err => {
                console.log(err)
            })
        }
    },

    created() {},
}
</script>

<style scoped>
input {
    width: 100%;
    height: 40px;
    border: 1px solid #d9dadc;
    border-radius: 0;
    background-color: #fff;
    background-image: none;
}

.custom-control-label::before, 
.custom-control-label::after {
    top: .8rem;
    width: 1.25rem;
    height: 1.25rem;
}
</style>