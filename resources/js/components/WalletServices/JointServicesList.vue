<template>
    <div class="box col-md-8 offset-md-2 mt-5">
        <div class="single-report mb-xs-30">
            <div class="s-report-inner pr--30 pt--30 mb-3">
                <div class="icon icon-background"><i class="ti-wallet"></i></div>
                    <div class="s-report-title d-flex justify-content-between">
                    <!-- content -->
                        <div class="card-body"> 
                            <div class="col-md-12">
                            <h4 class="header-title"> JOINT SERVICE</h4>
                            <div class="list-group" v-for="LJ in ListJointServices" :key="LJ.id">
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Joint Service Details</h5>
                                <!--<small class="text-muted">Remove this service</small>-->
                                </div>
                                <div class="form-group row mt-1">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label mb-1">Wallet Type</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control mb-1" id="inputEmail3" :value="LJ.s_wallet_type" placeholder="Wallet Type" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label mb-1">Service Code</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control mb-1" id="inputEmail3" :value="LJ.service_code" placeholder="Service Code" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label mb-1">Service Name</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control mb-1" id="inputEmail3" :value="LJ.service_name" placeholder="Service Name" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mt-1">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label mb-1">Service Description</label>
                                    <div class="col-sm-10">
                                    <input type="text" class="form-control mb-1" id="inputEmail3" :value="LJ.service_description" placeholder="Service Description" readonly>
                                    </div>
                                </div>
                                </a> 
            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
data(){
    return{
        ListJointServices : [],
        id : this.$route.params.id
    }
},
methods : {
    getListJointServices(){
        axios.get('/api/service/getjointservicelist/'+this.id) 
        .then((response) => {
              this.ListJointServices = response.data;
        })
        .catch(()=> {
            console.log('error');
        });
    },
},
created() {
this.getListJointServices()

}
}
</script>

<style>

</style>