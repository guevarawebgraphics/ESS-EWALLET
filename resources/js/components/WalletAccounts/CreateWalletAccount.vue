<template>
  <div id="CreateWalletAccount">
      <!-- Create Wallet Account Form -->
     <form @submit.prevent="editmode ? UpdateWalletAccount() : StoreWalletAccount()">
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
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('username') } " v-on:change="SearchESSID"  name="username" v-validate="'required'" type="text" v-model="form.username" placeholder="ESSID/Username" :disabled="editmode">
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
                                                <input type="file" @change="uploadKycForm" class="custom-file-input" id="kyc_form" ref="file">
                                                <label v-if="this.editmode == true" class="custom-file-label" for="kyc_form" id="kyc_form_filename">{{ form.kyc_form | substring }}</label>
                                                <label v-if="this.editmode == false" class="custom-file-label" for="kyc_form" id="kyc_form_filename">{{ kyc_form_file_name}}</label>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" @change="uploadValidId" class="custom-file-input" id="valid_id" ref="valid_id">
                                                <label v-if="this.editmode == true" class="custom-file-label" for="valid_id" id="valid_id_filename">{{ form.valid_id | substring }}</label>
                                                <label v-if="this.editmode == false" class="custom-file-label" for="valid_id" i="valid_id_filename">{{ valid_id_file_name }}</label>
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
                                    <!-- <div class="form-group">
                                        <label class="control-label custom-label" for="placeofbirth">Place of Birth</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('placeofbirth') }" name="placeofbirth" v-validate="'required'" v-model="form.placeofbirth" type="text" placeholder="Place of Birthdate" disabled>
                                        <has-error :form="form" field="birthdate"></has-error>
                                        <p class="text-danger" v-if="errors.has('placeofbirth')">{{errors.first('placeofbirth')}}</p>
                                    </div> -->
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
                                    <!-- <div class="form-group">
                                        <label class="control-label custom-label" for="NationalIdNo">National Id No</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('NationalIdNo') }" name="NationalIdNo" v-validate="'required'" v-model="form.NationalIdNo" type="text" placeholder="National Id No" disabled>
                                        <has-error :form="form" field="sss"></has-error>
                                        <p class="text-danger" v-if="errors.has('NationalIdNo')">{{errors.first('NationalIdNo')}}</p>
                                    </div> -->
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
            <tab-content title="E-Wallet Acount Setup" :before-change="ValidateSecondStep">
                <!-- Create Wallet Account Step 2 -->
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <!-- <hr> -->
                                    <!-- ESSID/Username -->
                                        <!-- <div class="form-group">
                                            <label class="control-label custom-label" for="ess_id">ESS ID/Username</label>
                                            <input class="form-control" v-model="form.username"  type="text" placeholder="ESSID/Username" disabled>
                                        </div> -->
                                        <!-- <hr> -->
                                        <h4>Wallet Details</h4>
                                        <!-- Wallet Type -->
                                        <div class="form-group mt-3">
                                            <label class="control-label custom-label" for="WalletType">Wallet Type</label>
                                            <select class="custom-select" :class="{ 'is-invalid': errors.has('WalletType') } "  name="WalletType" v-validate="'required'" v-on:change="ValidateSecondStep" v-model="form.WalletType">
                                                <option value="" selected disabled>Select</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Prepaid">Prepaid</option>
                                            </select>
                                            <has-error :form="form" field="WalletType"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletType')">{{errors.first('WalletType')}}</p>
                                        </div>
                                        <!-- Wallet Account Type -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountType">Wallet Account Type</label>
                                            <select class="custom-select" :class="{ 'is-invalid': errors.has('WalletAccountType') } "  name="WalletAccountType" v-on:change="ValidateSecondStep" v-validate="'required'"  v-model="form.WalletAccountType">
                                                <option value="" selected disabled>Select</option>
                                                <option v-for="wat in walletAccountTypes" :key="wat.id" :value="wat.id">
                                                    {{ wat.wallet_account_type}}
                                                </option>
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
                                <!--Joint Column-->
                                <div class="col-md-4 offset-md-1" :hidden="CheckWalletAccountType()">
                                    <hr>
                                    <h4>Joint Wallet Account</h4>
                                        <!-- Joint Wallet Type -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="JointWalletType">Joint Wallet Type</label>
                                            <select class="custom-select" :class="{ 'is-invalid' : errors.has('JointWalletType') }" name="JointWalletType" v-validate="'required'">
                                                <option value="" selected disabled>Select Joint Wallet Type</option>
                                                <option >Select Joint Wallet Type</option>
                                            </select>
                                        </div>
                                        <!-- Joint Wallet Account Type -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="JointWalletAccountType">Joint Wallet Account Type</label>
                                            <select class="custom-select" :class="{'is-invalid' : errors.has('JointWalletType') }" name="JointWalletType" v-validate="'required'">
                                                <option value="" selected disabled>Select Wallet Account Type</option>
                                                <option value="">Select Wallet Account Type</option>
                                            </select>
                                        </div>
                                        <!-- Joint Wallet Account No -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="JointWalletAccountNo">Joint Wallet Account No</label>
                                            <select class="custom-select" :class="{'is-invalid' : errors.has('JointWalletAccountNo') }" name="JointWalletAccountNo" v-validate="'required'" disabled>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- Joint Wallet Account Name -->
                                        <div class="form-group">
                                            <label class="control-label custom-label" for="JointWalletAccountName">Joint Wallet Account Name</label>
                                            <select class="custom-select" :class="{'is-invalid' : errors.has('JointWalletAccountName') }" name="JointWalletAccountName" v-validate="'required'" disabled>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- CMS Credit Account No -->
                                        <div class="form-group" v-if="form.WalletAccountType == 8">
                                            <label class="control-label custom-label" for="CMSCreditAccountNo">CMS Credit Account No</label>
                                            <input class="form-control" :class="{'is-invalid': errors.has('CMSCreditAccountNo') }" name="CMSCreditAccountNo" v-validate="'required'" type="text" placeholder="CMS Credit Account No">
                                            <p class="text-danger" v-if="errors.has('CMSCreditAccountNo')">{{errors.first('CMSCreditAccountNo')}}</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- E-Wallet Account Setup -->
            <tab-content title="E-Wallet Acount Setup" :before-change="ValidateWalletAccountDetails">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    <h4>Wallet Details</h4>
                                    <hr>
                                    <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountNameDetails">Account Name</label>
                                            <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountNameDetails') } "  name="WalletAccountNameDetails" v-validate="'required'" type="text" v-model="form.WalletAccountNameDetails" disabled>
                                            <has-error :form="form" field="WalletAccountNameDetails"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountNameDetails')">{{errors.first('WalletAccountNameDetails')}}</p>
                                    </div>
                                    <div class="form-group">
                                            <label class="control-label custom-label" for="WalletAccountNoDetails">Account No</label>
                                            <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountNoDetails') } " v-on:change="searchAccountNo"  name="WalletAccountNoDetails" v-validate="'required'" type="text" v-model="form.WalletAccountNoDetails">
                                            <has-error :form="form" field="WalletAccountNoDetails"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountNoDetails')">{{errors.first('WalletAccountNoDetails')}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ End E-Wallet Account Setup -->
            <!-- ./ E-Wallet Account Setup Step 2 -->
            <!-- E-Wallet Account Setup Step 3-->
            <!-- 
            <tab-content title="E-Wallet Acount Setup">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 offset-md-1">
                                    Account Name 
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountName">Wallet Account Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('WalletAccountName') } "  name="WalletAccountName" v-validate="'required'" type="text" v-model="form.WalletAccountName" placeholder="WalletAccountName" disabled>
                                            <has-error :form="form" field="WalletAccountName"></has-error>
                                            <p class="text-danger" v-if="errors.has('WalletAccountName')">{{errors.first('WalletAccountName')}}</p>
                                    </div>
                                    Account No
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
            </tab-content>-->
            <!--./ End E-Wallet Account Setup Step 3-->
            <!-- E-Wallet Account Setup Step 4 -->
            <tab-content title="E-Wallet Acount Setup" :before-change="ValidateFourthStep">
                <div class="box">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <h5>Designated Bank Account/s:</h5>
                            <hr>
                            <div class="row" id="bankRow">
                                <div class="col-md-4 offset-md-1" v-for="(key, index) in BankAccount" :key="index.id">
                                    
                                    <button class="float-right" @click.prevent="removeElement(index);" id="ba-close-button" style="cursor: pointer" v-if="index != 0">
                                        <span class="ti-close"></span>
                                    </button>
                                    <hr>
                                    <!-- Name of Bank -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="bank_name">Name of Bank</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('bank_name') } "  name="bank_name" v-validate="'required'" type="text" v-on:change="ValidateFourthStep" v-model="key.bank_name" placeholder="Name Of Bank">
                                            <has-error :form="form" field="bank_name"></has-error>
                                            <p class="text-danger" v-if="errors.has('bank_name')">{{errors.first('bank_name')}}</p>
                                    </div>
                                    <!-- Branch -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="Branch">Branch</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('Branch') } "  name="Branch" v-validate="'required'" type="text" v-on:change="ValidateFourthStep" v-model="key.Branch" placeholder="Branch">
                                            <has-error :form="form" field="Branch"></has-error>
                                            <p class="text-danger" v-if="errors.has('Branch')">{{errors.first('Branch')}}</p>
                                    </div>
                                    <!-- Account Type -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="account_type">Account Type</label>
                                        <!-- <input class="form-control" :class="{ 'is-invalid': errors.has('WalletType') } "  name="WalletType" v-validate="'required'" type="text" v-model="form.WalletType" placeholder="Account Type"> -->
                                        <select class="custom-select" :class="{ 'is-invalid': errors.has('account_type') } "  name="account_type" v-validate="'required'" v-on:change="ValidateFourthStep" v-model="key.account_type">
                                                <option value="" selected disabled>Select</option>
                                                <option>Credit</option>
                                                <option>Prepaid</option>
                                        </select>
                                        <has-error :form="form" field="account_type"></has-error>
                                        <p class="text-danger" v-if="errors.has('account_type')">{{errors.first('account_type')}}</p>
                                    </div>
                                    <!-- Account Name -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="WalletAccountName">Account Name</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('account_name') } "  name="account_name" v-validate="'required'" type="text" v-on:change="ValidateFourthStep" v-model="key.account_name" placeholder="Account Name">
                                            <has-error :form="form" field="account_name"></has-error>
                                            <p class="text-danger" v-if="errors.has('account_name')">{{errors.first('account_name')}}</p>
                                    </div>
                                    <!-- Account No -->
                                    <div class="form-group">
                                        <label class="control-label custom-label" for="account_no">Account No</label>
                                        <input class="form-control" :class="{ 'is-invalid': errors.has('account_no') } "  name="account_no" v-validate="'required'" type="text" v-on:change="ValidateFourthStep" v-model="key.account_no" placeholder="Account No">
                                            <has-error :form="form" field="account_no"></has-error>
                                            <p class="text-danger" v-if="errors.has('account_no')">{{errors.first('account_no')}}</p>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check custom-control custom-checkbox"> 
                                            <input type="checkbox" class="form-check-input" id="bank_default" name="default" v-model="key.default"> 
                                            <label class="form-check-label" for="bank_default">Default</label>
                                        </div>
                                        <div class="form-check custom-control custom-checkbox"> 
                                            <input type="checkbox" class="form-check-input" id="bank_status" name="status" v-model="key.status"> 
                                            <label class="form-check-label" for="bank_status">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Add New Bank Account -->
                                <button class="btn btn-primary btn-flat" @click.prevent="addBank" :hidden="BankAccount.length>2"> Add New Bank Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ End E-Wallet Account Setup 4 -->
            <!-- E-Wallet Account Setup 5 -->
            <tab-content title="E-Wallet Acount Setup">
                <!-- Box -->
                <div class="box">
                    <!-- Card -->
                    <div class="card shadow-custom">
                        <!-- Card Body -->
                        <div class="card-body">
                            <h5>Amount Limits:</h5>
                            <hr>
                            <!-- Row -->
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <!-- Unordered List -->
                                    <ul class="list-group list-group-flush">
                                        <!-- List item 1 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.amount_limit" type="checkbox" class="form-check-input" name="amount_limit" id="amount_limit"> 
                                                    <label class="form-check-label custom-label" for="amount_limit">
                                                        Amount Limit (minimum and maximum) of wallet balance at any givin time Minimum Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_minimum" name="am_minimum" id="" value="0">
                                                        Maximum Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_maximum" name="am_maximum" id="" value="200000">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 1 -->
                                        <!-- List item 2 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.am_per_transaction" name="am_per_transaction" type="checkbox" class="form-check-input" id="exampleCheck2"> 
                                                    <label class="form-check-label custom-label" for="exampleCheck2">
                                                        Amount Limit (minimum and maximum) per transaction: <input class="custom-limit-input" type="number" min="0" v-model="form.am_transaction_minimun" name="am_transaction_minimun" id="" value="0">
                                                        Maximum Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_transaction_maximum" name="am_transaction_maximum" id="" value="200000">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 2 -->
                                        <!-- List item 3 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.am_per_day" name="am_per_day" type="checkbox" class="form-check-input" id="exampleCheck3"> 
                                                    <label class="form-check-label custom-label" for="exampleCheck3">
                                                        Limit of total transaction amount per day Maximum Debit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_day_minimum" name="am_day_minimum" id="" value="0">
                                                        Maximum Credit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_day_maximum" name="am_day_maximum" id="" value="200000">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 3 -->
                                        <!-- List item 4 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.am_per_month" name="am_per_month" type="checkbox" class="form-check-input" id="exampleCheck4"> 
                                                    <label class="form-check-label custom-label" for="exampleCheck4">
                                                        Limit of total transaction amount per month Maximum Debit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_month_minimum" name="am_month_minimum" id="" value="0">
                                                        Maximum Credit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_month_maximum" name="am_month_maximum" id="" value="200000">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 4 -->
                                        <!-- List item 5 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.am_per_year" name="am_per_year" type="checkbox" class="form-check-input" id="exampleCheck5"> 
                                                    <label class="form-check-label custom-label" for="exampleCheck5">
                                                        Limit of total transaction amount per year Maximum Debit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_year_minimum" name="am_year_minimum" id="" value="0">
                                                        Maximum Credit Amount: <input class="custom-limit-input" type="number" min="0" v-model="form.am_year_maximum" name="am_year_maximum" id="" value="200000">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 5 -->
                                    </ul>
                                </div>
                            </div>
                            <!-- ./ Row -->
                        </div>
                        <!-- ./ Card Body -->
                    </div>
                    <!-- ./ Card -->
                </div>
                <!-- ./ Box -->
            </tab-content>
            <!-- ./ E-Wallet Account Setup 5 -->
             <!-- E-Wallet Account Setup 6 -->
            <tab-content title="E-Wallet Acount Setup">
                <!-- Box -->
                <div class="box">
                    <!-- Card -->
                    <div class="card shadow-custom">
                        <!-- Card body -->
                        <div class="card-body">
                            <h5>Limits No. Of Transactions</h5>
                            <hr>
                            <!-- Row -->
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <!-- Unordered List -->
                                    <ul class="list-group list-group-flush">
                                        <!-- List item 1 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_lm_per_day" type="checkbox" class="form-check-input" name="lm_per_day" id="amount_limit"> 
                                                    <label class="form-check-label custom-label" for="lm_per_day">
                                                        Limit no. of transactions per day Maximum No. of Transactions: <input class="custom-limit-input" type="number" min="0" v-model="form.lm_per_day" name="c_lm_per_day" id="c_lm_per_day" value="0">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 1 -->
                                        <!-- List item 2 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_lm_per_month" type="checkbox" class="form-check-input" name="lm_per_month" id="amount_limit"> 
                                                    <label class="form-check-label custom-label" for="lm_per_month">
                                                        Limit no. of transactions per month Maximum No. of Transactions: <input class="custom-limit-input" type="number" min="0"  v-model="form.lm_per_month" name="c_lm_per_month" id="c_lm_per_day" value="0">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 2 -->
                                        <!-- List item 3 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_lm_per_year" type="checkbox" class="form-check-input" name="lm_per_year" id="lm_per_year"> 
                                                    <label class="form-check-label custom-label" for="lm_per_year">
                                                        Limit no. of transactions per year Maximum No. of Transactions: <input class="custom-limit-input" min="0" v-model="form.lm_per_year" type="number" name="c_lm_per_year" id="c_lm_per_year" value="0">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 3 -->
                                        <h5 class="custom-label">Other Options</h5>
                                        <!-- List item 4 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_allow_negative_balance" type="checkbox" class="form-check-input" name="allow_negative_balance" id="allow_negative_balance"> 
                                                    <label class="form-check-label custom-label" for="allow_negative_balance">
                                                        Allow negative Balance Maximum negative Balance: <input class="custom-limit-input" type="number" v-model="form.allow_negative_balance" name="c_allow_negative_balance" id="c_allow_negative_balance" value="0">
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 4 -->
                                        <!-- List item 5 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_com_daily_balance" type="checkbox" class="form-check-input" name="com_daily_balance" id="com_daily_balance"> 
                                                    <label class="form-check-label custom-label" for="com_daily_balance">
                                                        Compute Average Daily Balance
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 5 -->
                                        <!-- List item 6 -->
                                        <li class="list-group-item">
                                            <div class="form-group row">
                                                <div class="form-check custom-control custom-checkbox"> 
                                                    <input v-model="form.c_com_daily_usage" type="checkbox" class="form-check-input" name="com_daily_usage" id="com_daily_usage"> 
                                                    <label class="form-check-label custom-label" for="com_daily_usage">
                                                        Compute Average Daily Usage
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- ./ List item 6 -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ E-Wallet Account Setup 6  -->
             <!-- E-Wallet Account Setup 7 -->
            <tab-content title="E-Wallet Acount Setup">
                <!-- Box -->
                <div class="box">
                    <!-- Card -->
                    <div class="card shadow-custom">
                        <!-- Card body -->
                        <div class="card-body">
                            <h5>Service Matrix</h5>
                            <hr>
                            <!-- Row Table -->
                        <div class="form-group row">
                            <!-- Cold lg 6 -->
                            <div class="col-md-12">
                                <div class="header-title">Services Matrix Setup</div>
                                <div class="data-tables datatable-dark">
                                    <!-- Table -->
                                    <table class="table table-hover table-bordered text-center" id="service_matrix">
                                        <thead class="text-capitalize">
                                            <tr class="th-table">
                                                <th colspan="3"><h3>Service Matrix</h3></th>
                                                <!-- <th>Applies To:</th> -->
                                                <th colspan="2">Admin</th>
                                                <th colspan="2">Merchant</th>
                                                <th colspan="2">Branch</th>
                                                <th colspan="2">Agent</th>
                                            </tr>
                                            <tr class="th-table">
                                                <th>Service Type</th>
                                                <th>Service Name</th>
                                                <th>Group</th>
                                                <!-- <th>Inc. Redeem</th> -->
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>
                                                <th>All</th>
                                                <th>Some</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="sm in Services" :key="sm.id">
                                                <td>{{sm.st_name}}</td>
                                                <td>{{sm.service_name}}</td>
                                                <td>{{sm.group_description}}</td>
                                                <!-- <td>Test</td> -->
                                                <td><input :key="sm.id" type="checkbox" name="admin_all[]" class="form-check-input" v-model="sm.admin_all" id="admin_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="admin_some[]" class="form-check-input" v-model="sm.admin_some" id="admin_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="merchant_all[]" class="form-check-input" v-model="sm.merchant_all" id="merchant_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="merchant_some[]" class="form-check-input" v-model="sm.merchant_some" id="merchant_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="branch_all[]" class="form-check-input" v-model="sm.branch_all" id="branch_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="branch_some[]" class="form-check-input" v-model="sm.branch_some" id="branch_some"></td>
                                                <td><input :key="sm.id" type="checkbox" name="agent_all[]" class="form-check-input" v-model="sm.agent_all" id="agent_all"></td>
                                                <td><input :key="sm.id" type="checkbox" name="agent_some[]" class="form-check-input" v-model="sm.agent_some" id="agent_some"></td>
                                                <!-- <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.admin" name="admin[]" class="custom-control-input" v-bind:id="'admin' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.admin == true" v-bind:for="'admin' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.admin == false" v-bind:for="'admin' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                 <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.merchant" name="merchant[]" class="custom-control-input" v-bind:id="'merchant' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.merchant == true" v-bind:for="'merchant' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.merchant == false" v-bind:for="'merchant' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.branch" name="branch[]" class="custom-control-input" v-bind:id="'branch' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.branch == true" v-bind:for="'branch' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.branch == false" v-bind:for="'branch' + sm.id">SOME</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input :key="sm.id" type="checkbox" v-model="sm.agent" name="agent[]" class="custom-control-input" v-bind:id="'agent' + sm.id">
                                                        <label class="custom-control-label" v-if="sm.agent == true" v-bind:for="'agent' + sm.id">ALL</label>
                                                        <label class="custom-control-label" v-if="sm.agent == false" v-bind:for="'agent' + sm.id">SOME</label>
                                                    </div>
                                                </td> -->
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- ./ Table -->
                                </div>
                            </div>
                        </div>
                        <!-- ./ Row Table -->
                        </div>
                    </div>
                </div>
            </tab-content>
            <!-- ./ E-Wallet Account Setup 7  -->
            <!-- Form Wizzard Footer -->
            <template slot="footer" slot-scope="props">
                <div class="wizard-footer-left">
                <wizard-button  v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :disabled="errors.items.length>0" :style="props.fillButtonStyle">Previous</wizard-button>
                </div>
                <div class="wizard-footer-right">
                <wizard-button v-if="!props.isLastStep" @click.native="props.nextTab()" id="nextTab" :disabled="errors.items.length>0" class="wizard-footer-right" :style="props.fillButtonStyle">Next <span class="ti-arrow-right"></span></wizard-button>
                <wizard-button v-else @click.native="editmode ? UpdateWalletAccount() : StoreWalletAccount()" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">  {{props.isLastStep ? 'Done' : 'Next'}} <span class="ti-saves"></span></wizard-button>
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
         csrf_token: $('meta[name="csrf-token"]').attr('content'),
         editmode: false,
         switching: false,
         wai: null,
         step: 0,
         account: [],
         BankAccount: [
           {
            bank_name: null,
            Branch: null,
            account_type: null,
            account_name: null,
            account_no: null,
            default: false,
            status: false,
           }
         ],
         Services: {},
         walletAccountTypes: [],
         kyc_form_file_name: "Filled-Up KYC Form",
         valid_id_file_name: "Valid ID w/ Signature",
         form: new Form({
           username: null,
           lastname: null,
           firstname: null,
           middlename: null,
           presentaddress: null,
           permanentaddress: null,
           birthdate: null,
           //placeofbirth: null,
           nationality: null,
           contactNo: null,
           emailaddress: null,
           tin: null,
           sss: null,
           //NationalIdNo: null,
           EmployerName: null,
           BusinessName: null,
           WalletType: null,
           WalletAccountType: null,
           WalletAccountNo: null,
           WalletAccountName: null,
           Wallettitle: null,
           //NameOfBank: null,
            // Wallet Bank Account Details
           bank_name: null,
           Branch: null,
           account_type: null,
           account_name: null,
           account_no: null,
           // Wallet Amount limits config
           amount_limit: 0,
           am_per_transaction: 0,
           am_per_day: 0,
           am_per_month: 0,
           am_per_year: 0,
           // Wallet Amount Limits
           am_minimum: 0,
           am_maximum: 0,
           am_transaction_minimun: 0,
           am_transaction_maximum: 0,
           am_day_minimum: 0,
           am_day_maximum: 0,
           am_month_minimum: 0,
           am_month_maximum: 0,
           am_year_minimum: 0,
           am_year_maximum: 0,
           // Wallet limit no of transaction config
           c_lm_per_day: 0,
           c_lm_per_month: 0,
           c_lm_per_year: 0,
           c_allow_negative_balance: 0,
           c_com_daily_balance: 0,
           c_com_daily_usage: 0,
           // Wallet limit no of transaction
           lm_per_day: 0,
           lm_per_month: 0,
           lm_per_year: 0,
           allow_negative_balance: 0,
           // Files
           kyc_form: null,
           valid_id: null,
           // Wallet Account Details
           WalletAccountNoDetails: null,
           WalletAccountNameDetails: null,

        })
        }
    },
    methods: {
        datatable(){
            setTimeout(function(){
                let table = $('#service_matrix').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    //scrollX: true,
                    "autoWidth": true,
                    lengthChange: true,
                    responsive: true,
                    fixedColumns: false,
                });
            }, (this.editmode == true) ? 2000 : 1000);
        },
        onComplete: function(){
          alert('Yay. Done!');
        },
        /**
         * @ Validate First Step 
         **/
        ValidateFirstStep(){
            // if(this.form.emailaddress != null){
            //     if(this.step == 1){
            //         this.errors.clear()
            //         return true;
            //     }
            //     else {
            //         this.form.reset()
            //         $('#nextTab').attr('disabled', true)
            //         this.step = 0;
            //         return false;
            //     }
            // }
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
                this.step = 0;
                return false;
            }
            else if(this.form.kyc_form == null){
                 toast.fire({
                    type: 'info',
                    title: 'KYC Form is Required',
                    timer: 10000,
                })
                this.$validator.validateAll().then(result => {
                    if (result) {
                    alert("Form Submitted!");
                    return;
                    }
                });
                this.step = 0;
                return false;
            }
            else if(this.form.valid_id == null){
                 toast.fire({
                    type: 'info',
                    title: 'Valid ID is Required',
                    timer: 10000,
                })
                this.$validator.validateAll().then(result => {
                    if (result) {
                    alert("Form Submitted!");
                    return;
                    }
                });
                this.step = 0;
                return false;
            }
            else {
                this.errors.clear()
                return true;
            }
        },
        /**
         * @ Validate Second Step 
         **/
        ValidateSecondStep(){
            if(this.form.WalletAccountType != null && this.form.WalletType != null){
                this.errors.clear()
                $('#nextTab').removeAttr('disabled')
                return true;
            }
            if(this.form.WalletType == null || this.form.WalletAccountType == null){
                // toast.fire({
                //     type: 'info',
                //     title: 'Please fill required fields'
                // })
                this.$validator.validateAll().then(result => {
                    if (result) {
                        return;
                    }
                });
                return false;
            }
            else {
                return true;
            }
        },
        /**
         * @ Validate Fourth Step 
         **/
        ValidateFourthStep(){
            var i;
            for (i = 0; i < this.BankAccount.length; i++) {
                if(this.BankAccount[i].bank_name != null && this.BankAccount[i].Branch != null && this.BankAccount[i].account_type != null && this.BankAccount[i].account_name != null && this.BankAccount[i].account_no != null){
                    this.errors.clear()
                    $('#nextTab').removeAttr('disabled')
                    return true;
                }
                if(this.BankAccount[i].bank_name == null || this.BankAccount[i].Branch == null || this.BankAccount[i].account_type == null || this.BankAccount[i].account_name == null || this.BankAccount[i].account_no == null){
                    // toast.fire({
                    //     type: 'info',
                    //     title: 'Please fill required fields'
                    // })
                    this.$validator.validateAll().then(result => {
                        if (result) {
                            return;
                        }
                    });
                    return false;
                }
                else {
                    this.errors.clear()
                    $('#nextTab').removeAttr('disabled')
                    return true;
                }
            }

        },
        /**
         * @ ValidateWalletAccountDetails 
         **/
        ValidateWalletAccountDetails(){
            // console.log('asdfs')
            if(this.form.WalletAccountNoDetails == null){
                toast.fire({
                    type: 'info',
                    title: 'Please fill required fields'
                })
                this.$validator.validateAll().then(result => {
                    if (result) {
                        return;
                    }
                });
                return false;
            }
            else {
                this.errors.clear();
                $('#nextTab').removeAttr('disabled')
                return true;
            }
        },
        /**
         *@ Search For Account ESS ID 
         **/
        SearchESSID(){
            if(!this.form.username){
                if(this.step == 1){
                    this.form.clear()
                    this.form.reset()
                    $('#nextTab').attr('disabled', true)
                }
            }
            else {
                let ess_id = (this.editmode ? this.$route.params.id :  this.form.username);
                axios.get('/api/account/' + ess_id)
                .then(response => {
                    if(response.data.length > 0 && this.form.username != null){
                        this.step = 1;
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
                        this.step = 0;
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
         * @ Edit Wallet Account 
         **/
        EditWalletAccount(){
            /**
             * @ Check if the params is not empty then editmode = true 
             **/
            let ess_id = this.$route.params.id;
            if(ess_id != null){
                this.editmode = true;
                this.form.username = ess_id;
            }
        },
        /**
         * @ Generate Account No 
         **/ 
        GenerateAccountNo(){
            if(!this.editmode){
                axios.get('/api/GenerateAccountNo')
                .then(response => {
                    this.form.WalletAccountNo = response.data
                })
                .catch(err => {
                    console.log(err)
                })
            }
        },
        /**
         * @ UpdateWalletAccount
         **/
        UpdateWalletAccount(){
            swal.fire({
            title: 'Are you sure you want to save?',
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0077B5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Update!'
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start()
                    let formData = new FormData();
                    // Wallet Account
                    formData.append('_token', this.csrf_token)
                    formData.append('username', this.form.username)
                    formData.append('kyc_form', this.form.kyc_form)
                    formData.append('valid_id', this.form.valid_id)
                    formData.append('WalletType', this.form.WalletType)
                    formData.append('WalletAccountType', this.form.WalletAccountType)
                    formData.append('WalletAccountNo', this.form.WalletAccountNo)
                    formData.append('WalletAccountName', this.form.WalletAccountName)
                    formData.append('Wallettitle', this.form.Wallettitle)
                    // //Wallet Bank Account
                    formData.append('Branch', this.form.Branch)
                    formData.append('bank_name', this.form.bank_name)
                    formData.append('account_type', this.form.account_type)
                    formData.append('account_name', this.form.account_name)
                    formData.append('account_no', this.form.account_no)
                    // Wallet Amount limits config
                    formData.append('amount_limit', this.form.amount_limit)
                    formData.append('am_per_transaction', this.form.am_per_transaction)
                    formData.append('am_per_day', this.form.am_per_day)
                    formData.append('am_per_month', this.form.am_per_month)
                    formData.append('am_per_year', this.form.am_per_year)
                    // Wallet Amount Limits
                    formData.append('am_minimum', this.form.am_minimum)
                    formData.append('am_maximum', this.form.am_maximum)
                    formData.append('am_transaction_minimum', this.form.am_transaction_minimun)
                    formData.append('am_transaction_maximum', this.form.am_transaction_maximum)
                    formData.append('am_day_minimum', this.form.am_day_minimum)
                    formData.append('am_day_maximum', this.form.am_day_maximum)
                    formData.append('am_month_minimum', this.form.am_month_minimum)
                    formData.append('am_month_maximum', this.form.am_month_maximum)
                    formData.append('am_year_minimum', this.form.am_year_minimum)
                    formData.append('am_year_minimum', this.form.am_year_minimum)
                    formData.append('am_year_maximum', this.form.am_year_maximum)
                    // Wallet limit no of transaction config
                    formData.append('c_lm_per_day', this.form.c_lm_per_day)
                    formData.append('c_lm_per_month', this.form.c_lm_per_month)
                    formData.append('c_lm_per_year', this.form.c_lm_per_year)
                    formData.append('c_allow_negative_balance', this.form.c_allow_negative_balance)
                    formData.append('c_com_daily_balance', this.form.c_com_daily_balance)
                    formData.append('c_com_daily_usage', this.form.c_com_daily_usage)
                    // Wallet limit no of transaction
                    formData.append('lm_per_day', this.form.lm_per_day)
                    formData.append('lm_per_month', this.form.lm_per_month)
                    formData.append('lm_per_year', this.form.lm_per_year)
                    formData.append('allow_negative_balance', this.form.allow_negative_balance)
                    formData.append('BankAccount', JSON.stringify(this.BankAccount))
                    formData.append('Services', JSON.stringify(this.Services))
                    formData.append('WalletAccountNoDetails', this.form.WalletAccountNoDetails)
                    formData.append('WalletAccountNameDetails', this.form.WalletAccountNameDetails)
                    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                    axios.post('/api/walletaccount/UpdateWalletAccount', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            'X-CSRF-TOKEN': this.csrf_token
                        }
                    })
                    .then(res => {
                    this.$Progress.increase(10)
                    this.$Progress.finish()
                    console.log(res)
                        this.form.clear()
                        this.form.reset()
                        toast.fire({
                            type: 'success',
                            title: 'Wallet Account Successfully Updated!'
                        })
                        this.$router.push('/walletaccounts')
                        console.log(res.data.status)
                    })
                    .catch((err) => {
                        this.$Progress.fail()
                        console.log(err)
                    })
                }
            })
            
        },
        /**
         * @ Store Wallet Account 
         **/
        StoreWalletAccount(){
            swal.fire({
                title: 'Are you sure you want to save?',
                type: 'info',
                showCancelButton: true,
                confirmButtonColor: '#0077B5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save!'
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start()
                    let formData = new FormData();
                    // Wallet Account
                    formData.append('_token', this.csrf_token)
                    formData.append('username', this.form.username)
                    formData.append('kyc_form', this.form.kyc_form)
                    formData.append('valid_id', this.form.valid_id)
                    formData.append('WalletType', this.form.WalletType)
                    formData.append('WalletAccountType', this.form.WalletAccountType)
                    formData.append('WalletAccountNo', this.form.WalletAccountNo)
                    formData.append('WalletAccountName', this.form.WalletAccountName)
                    formData.append('Wallettitle', this.form.Wallettitle)
                    // //Wallet Bank Account
                    formData.append('Branch', this.form.Branch)
                    formData.append('bank_name', this.form.bank_name)
                    formData.append('account_type', this.form.account_type)
                    formData.append('account_name', this.form.account_name)
                    formData.append('account_no', this.form.account_no)
                    // Wallet Amount limits config
                    formData.append('amount_limit', this.form.amount_limit)
                    formData.append('am_per_transaction', this.form.am_per_transaction)
                    formData.append('am_per_day', this.form.am_per_day)
                    formData.append('am_per_month', this.form.am_per_month)
                    formData.append('am_per_year', this.form.am_per_year)
                    // Wallet Amount Limits
                    formData.append('am_minimum', this.form.am_minimum)
                    formData.append('am_maximum', this.form.am_maximum)
                    formData.append('am_transaction_minimum', this.form.am_transaction_minimun)
                    formData.append('am_transaction_maximum', this.form.am_transaction_maximum)
                    formData.append('am_day_minimum', this.form.am_day_minimum)
                    formData.append('am_day_maximum', this.form.am_day_maximum)
                    formData.append('am_month_minimum', this.form.am_month_minimum)
                    formData.append('am_month_maximum', this.form.am_month_maximum)
                    formData.append('am_year_minimum', this.form.am_year_minimum)
                    formData.append('am_year_minimum', this.form.am_year_minimum)
                    formData.append('am_year_maximum', this.form.am_year_maximum)
                    // Wallet limit no of transaction config
                    formData.append('c_lm_per_day', this.form.c_lm_per_day)
                    formData.append('c_lm_per_month', this.form.c_lm_per_month)
                    formData.append('c_lm_per_year', this.form.c_lm_per_year)
                    formData.append('c_allow_negative_balance', this.form.c_allow_negative_balance)
                    formData.append('c_com_daily_balance', this.form.c_com_daily_balance)
                    formData.append('c_com_daily_usage', this.form.c_com_daily_usage)
                    // Wallet limit no of transaction
                    formData.append('lm_per_day', this.form.lm_per_day)
                    formData.append('lm_per_month', this.form.lm_per_month)
                    formData.append('lm_per_year', this.form.lm_per_year)
                    formData.append('allow_negative_balance', this.form.allow_negative_balance)
                    formData.append('BankAccount', JSON.stringify(this.BankAccount))
                    formData.append('Services', JSON.stringify(this.Services))
                    formData.append('WalletAccountNoDetails', this.form.WalletAccountNoDetails)
                    formData.append('WalletAccountNameDetails', this.form.WalletAccountNameDetails)
                    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                    axios.post('api/walletaccount/StoreWalletAccount', formData, {
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
                            toast.fire({
                                type: 'success',
                                title: 'Wallet Account Successfully created!'
                            })
                            this.$router.push('/walletaccounts')
                        }
                        console.log(res)
                    })
                    .catch(err => {
                        this.$Progress.fail()
                        //console.log(err)
                        console.clear()
                        if(err.response.status == 422){
                            toast.fire({
                                type: 'info',
                                title: 'Wallet Account Already Exists!'
                            })
                        }
                    })
                }
            })

        },
        /**
         * @ Get Wallet Account Type 
         **/
        GetWalletAccountType(){
            axios.get('/api/walletaccount/GetAllWalletAccountType').then(({ data}) => (this.walletAccountTypes = data));
        },
        /**
         * @ Get Wallet Account Details 
         **/
        GetWalletAccountDetails(){
            //axios.get('api/walletaccount/GetWalletAccountDetails/'+ this.form.username).then(({ data}) => (console.log(data)));
            axios.get('/api/walletaccount/GetWalletAccountDetails/'+ this.$route.params.id)
            .then(res => {
                //console.log(res)
                this.form.WalletAccountType = res.data[0]['wallet_account_type'];
                this.form.WalletType = res.data[0]['wallet_type'];
                this.form.Branch = res.data[0]['branch'];
                this.form.account_name = res.data[0]['account_name'];
                this.form.account_no = res.data[0]['account_no'];
                this.form.amount_limit = res.data[0]['amount_limit'];
                this.form.am_per_transaction = res.data[0]['am_per_transaction'];
                this.form.am_per_day = res.data[0]['am_per_day'];
                this.form.am_per_month = res.data[0]['am_per_month'];
                this.form.am_per_year = res.data[0]['am_per_year'];
                this.form.am_minimum = res.data[0]['am_minimum'];
                this.form.am_maximum = res.data[0]['am_maximum'];
                this.form.am_transaction_minimun = res.data[0]['am_transaction_minimum'];
                this.form.am_transaction_maximum = res.data[0]['am_transaction_maximum'];
                this.form.am_day_minimum = res.data[0]['am_day_minimum'];
                this.form.am_day_maximum = res.data[0]['am_day_maximum'];
                this.form.am_month_minimum = res.data[0]['am_month_minimum'];
                this.form.am_month_maximum = res.data[0]['am_month_maximum'];
                this.form.am_year_minimum = res.data[0]['am_year_minimum'];
                this.form.am_year_maximum = res.data[0]['am_year_maximum'];
                this.form.c_lm_per_day = res.data[0]['c_lm_per_day'];
                this.form.c_lm_per_month = res.data[0]['c_lm_per_month'];
                this.form.c_lm_per_year = res.data[0]['c_lm_per_year'];
                this.form.c_allow_negative_balance = res.data[0]['c_allow_negative_balance'];
                this.form.c_com_daily_balance = res.data[0]['c_com_daily_balance'];
                this.form.c_com_daily_usage = res.data[0]['c_com_daily_usage'];
                this.form.lm_per_day = res.data[0]['lm_per_day'];
                this.form.lm_per_month = res.data[0]['lm_per_month'];
                this.form.lm_per_year = res.data[0]['lm_per_year'];
                this.form.allow_negative_balance = res.data[0]['allow_negative_balance'];
                this.form.bank_name = res.data[0]['bank_name'];
                this.form.account_type = res.data[0]['account_type'];
                this.form.kyc_form =   res.data[0]['kyc_form'];
                this.form.valid_id =  res.data[0]['valid_id'];
                this.form.WalletAccountNoDetails = res.data[0]['WalletAccountNoDetails'];
                this.form.WalletAccountNameDetails = res.data[0]['WalletAccountNameDetails'];
                
            })
            .catch(err => {
                console.log(err)
            })
        },
        GetWalletBankAccounts(){
            this.BankAccount.splice(0, 1)
            axios.get('/api/walletaccount/GetWalletBankAccount/'+ this.$route.params.id)
            .then(res => {
                var i;
                for (i = 0; i < res.data.length; i++) {
                    this.BankAccount.push({
                        id: res.data[i].id,
                        bank_name: res.data[i].bank_name,
                        Branch: res.data[i].branch,
                        account_type: res.data[i].account_type,
                        account_name: res.data[i].account_name,
                        account_no: res.data[i].account_no,
                        default: res.data[i].default,
                        status: res.data[i].status,
                    })
                }
            })
            .catch(err => {
                console.log(err)
            })
        },
        /**
         * @ Get Kyc Form File 
         **/
        GetKycForm(){
            let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/"+ this.form.photo ;
            return photo; 
        },
        /**
         * @ Get Kyc Form File 
         **/
        uploadKycForm(e){
            e.preventDefault()
            this.form.kyc_form = this.$refs.file.files[0];
            this.errors.clear()
            //$('#kyc_form_filename').html(this.$refs.file.files[0].name);
            this.kyc_form_file_name = e.target.files[0].name;
            console.log(e.target.files[0].name)
            return true;
        },
        /**
         * Upload Valid Id 
         **/
        uploadValidId(e){
            e.preventDefault()
            this.form.valid_id = this.$refs.valid_id.files[0];
            this.errors.clear()
            //$('#valid_id_filename').html(e.target.files.name);
            this.valid_id_file_name = e.target.files[0].name;
            return true;
        },
        /**
         * @ Get Services 
         **/
        GetServices(){
            if(this.editmode == false){
                axios.get('api/servicematrix/GetServices').then(({ data }) => (this.Services = data));
            }
        },
        /**
         * @ Get Service Matrix Config For Update 
         **/
        Getsmc(){
            if(this.editmode == true){
                axios.get('/api/walletaccount/GetServiceMatrixConfig/'+ this.$route.params.id).then(({ data }) => (this.Services = data));
            }
        },
        /**
         * @ Check Wallet Account Type 
         **/
        CheckWalletAccountType(){
            // Check if Prepaid User
            if(this.form.WalletAccountType == 5){
                return false;
            }
            // Check if Credit User
            if(this.form.WalletAccountType == 8){
                return false;
            }
            return true;
        },
        /**
         * @ Add Bank Account  
         **/
        addBank() {
            this.BankAccount.push({
                bank_name: null,
                Branch: null,
                account_type: null,
                account_name: null,
                account_no: null,
                default: false,
                status: false,
            })
        },
        /**
         * @ Remove Bank Account 
         **/
        removeElement(index) {
            this.BankAccount.splice(index, 1);
        },
        searchAccountNo(){
            axios.get('/api/walletaccount/SearchWalletAccountNo/' + this.form.WalletAccountNoDetails)
            .then(res => {
                console.log(res)
                if(res){
                    if(res.data == 404){
                        this.form.WalletAccountNameDetails = null
                        toast.fire({
                            type: 'info',
                            title: 'Wallet Account No Not Found'
                        })
                        this.$validator.validateAll().then(result => {
                            if (result) {
                                return;
                            }
                        });
                        return false;
                    }
                    else{
                        this.form.WalletAccountNameDetails = res.data
                        this.errors.clear();
                        $('#nextTab').removeAttr('disabled')
                        return true;
                    }
                   
                }

            })
            .catch(err => {
                console.log(err)
            })
        }
    },

    created() {
        if(this.editmode == false){
            this.GetWalletAccountType();
            this.EditWalletAccount()
            this.SearchESSID()
            this.datatable()
            this.GetServices()
        }
       
        if(this.editmode == true){
            this.GetWalletAccountDetails()
            this.GetWalletBankAccounts()
            this.Getsmc()
        }
        
    },
}
</script>

<style scoped>
/* input {
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
} */

.custom-limit-input {
    width: 15%;
}

#ba-close-button{
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
    margin-bottom: "2px";
}
</style>