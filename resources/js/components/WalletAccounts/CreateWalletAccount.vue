<template>
  <div id="CreateWalletAccount">
      <!-- <h1>Create Wallet Accounts</h1> -->
      <form-wizard @on-complete="onComplete" title="Create Wallet Account" subtitle="Details">
        <tab-content title="E-Wallet Account Information (KYC)">
            <div class="box ptb--100">
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <input class="form-control input-rounded" type="text" placeholder="ESSID/Username">
                        </div>
                        </div>
                    </div>
                </form>
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