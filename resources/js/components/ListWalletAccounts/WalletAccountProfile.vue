<template>
    <div id="wallet-accouunt-profile">
        <div class="box ptb--100">
            <!-- Card -->
                <div class="card shadow-custom">
                    <!-- Card body -->
                        <div class="card-body">
                            <!-- Form Group Row -->
                            <div class="form-group row">
                                <!-- Col -->
                                <div class="col-md-12">
                                    <i class="ti-arrow-left" @click="back"> &nbsp; </i><label>{{ wan }}</label>
                                    <h4 class="header-title mt3"> </h4>
                                    <div class="form-group row">
                                        <div class="col md-6">
                                            <a class="btn btn-primary btn-md text-white">Available Services</a>
                                            <router-link to="/listmerchants" class="btn btn-primary btn-md text-white">List of Merchants</router-link>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./ Col -->
                            </div>
                            <!-- ./ Form Group Row -->
                        </div>
                    <!-- ./ Card body -->
                </div>
            <!-- ./ Card -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            wan: this.$route.params.wi
        }
    },
    methods: {
        back(){
            this.$router.push('/listwalletaccounts')
        }
    }
}
</script>

<style>

</style>