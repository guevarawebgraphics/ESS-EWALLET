<template>
  <div id="CreateWalletAccount">
      <!-- <h1>Create Wallet Accounts</h1> -->
      <form-wizard @on-complete="onComplete" title="Create Wallet Account" subtitle="Details" color="#3498db">
        <tab-content title="E-Wallet Account Information (KYC)">
            <div class="box ptb--100">
            <!-- Create Wallet Account Form -->
                <form>
                    <div class="row">
                        <div class="col-md-4 offset-md-1">
                            <hr>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="ESSID/Username">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Lastname">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Firstname">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Middlename">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Present Address">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Permanent Address">
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
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02">
                                        <label class="custom-file-label" for="inputGroupFile02">Valid ID w/ Signature</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-1">
                            <hr>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Date of birth">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Place of Birth">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Nationality">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Contact Nos.">
                            </div>
                            <div class="form-group mb-3">
                                <input class="form-control input-rounded" type="text" placeholder="Email Address">
                            </div>
                            <h6>Goverment Numbers</h6>
                            <hr>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Tin">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="SSS/GSIS No.">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="National ID No.">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Name of Employer">
                            </div>
                            <div class="form-group">
                                <input class="form-control input-rounded" type="text" placeholder="Name of Business">
                            </div>
                        </div>
                    </div>
                </form>
            <!--./ End Wallet Form-->
            </div>
        </tab-content>
        <tab-content title="E-Wallet Acount Setup">
            My second tab content
        </tab-content>
        <tab-content title="E-Wallet Acount Setup">
            Yuhuuu! This seems pretty damn simple
        </tab-content>
        <tab-content title="E-Wallet Acount Setup">
            Yuhuuu! This seems pretty damn simple
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