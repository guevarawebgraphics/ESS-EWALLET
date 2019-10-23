<template>
    <div id="editservicetype">
    
        <div class="col-12 mt-5">
            <div class="card">
            <div class="card-body"> 
            <div class="col-sm-7">
            <h4 class="header-title">Service Type Details</h4> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Code</label>
                <div class="col-sm-10">
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" v-model="form.service_code"  placeholder="Code" disabled>
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name</label>
                <div class="col-sm-10">
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3"  v-model="form.service_name"  placeholder="Name">
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description</label>
                <div class="col-sm-10">
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3"  v-model="form.service_description"  placeholder="Description">
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>  
        <div class="col-sm-12 mt-5"> 
          
            <div class="card">
            <div class="card-body">
                      <div class="col-sm-7">
            <h4 class="header-title">Behavior</h4>
            <form action="#">
                  <ul class="list-group list-group-flush"> 
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox ">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.added_ssw_sdw)" v-on:click="added_ssw_sdw(form.added_ssw_sdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single source wallet, added to single destination wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.added_ssw_mdw)" v-on:click="added_ssw_mdw(form.added_ssw_mdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single source wallet, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.added_msw_sdw)" v-on:click="added_msw_sdw(form.added_msw_sdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to single destination wallet</label>
                </div>
            </li> 
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.added_msw_mdw)" v-on:click="added_msw_mdw(form.added_msw_mdw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.deducted_sdw_ssw)" v-on:click="deducted_sdw_ssw(form.deducted_sdw_ssw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single destination wallets, deducted from single source wallet</label>
                </div> 
             </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.deducted_sdw_msw)" v-on:click="deducted_sdw_msw(form.deducted_sdw_msw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single destination wallet, deducted from multiple source wallets</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.deducted_mdw_ssw)" v-on:click="deducted_mdw_ssw(form.deducted_mdw_ssw)">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from single source wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox"> 
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" :checked="checkItem(form.deducted_mdw_msw)" v-on:click="deducted_mdw_msw(form.deducted_mdw_msw)"> 
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets</label>
                </div>
            </li>
            </ul>
            </form>
                      </div> 
                     <router-link :to="{ name: '/st-setup', params: { id: id_value }}" class="btn btn-primary float-right btn-lg btn-custom" @click.native="updateDetailsBehavior()">Save & Next</router-link>
            </div> 
            
            </div> 
            
        </div>
        
    </div>
</template>

<script>
export default {
data(){
    return{
        id_value : this.$route.params.id, //value of the parameter 
        /***
         * Declaration of the new form and an object DetailsBehavior
         */
        DetailsBehavior : [],
        form : new Form({
        service_code : null,
        service_name : null,
        service_description : null,
        added_ssw_sdw : null,
        added_ssw_mdw : null,
        added_msw_sdw : null,
        added_msw_mdw : null,
        deducted_sdw_ssw : null,
        deducted_sdw_msw : null,
        deducted_mdw_ssw : null,
        deducted_mdw_msw : null,
        }), 
    }

},
methods : {
    /**
     * For inserting the response data into form data
     */
    showDetailsAndBehavior() {
            axios.get('/api/behavior/'+this.id_value)
                .then(response => {
                    this.DetailsBehavior = response.data; 
                    this.form.service_code = response.data['st_code'];
                    this.form.service_name = response.data['st_name'];
                    this.form.service_description = response.data['st_description'];
                    this.form.added_ssw_sdw =response.data['added_ssw_sdw'];
                    this.form.added_ssw_mdw = response.data['added_ssw_mdw'];
                    this.form.added_msw_sdw = response.data['added_msw_sdw'];
                    this.form.added_msw_mdw = response.data['added_msw_mdw'];
                    this.form.deducted_sdw_ssw = response.data['deducted_sdw_ssw'];
                    this.form.deducted_sdw_msw = response.data['deducted_sdw_msw']; 
                    this.form.deducted_mdw_ssw = response.data['deducted_mdw_ssw']; 
                    this.form.deducted_mdw_msw =response.data['deducted_mdw_msw']; 
                    $('.form-check-label').click(false);  
                }) 
    },
    /***
     * For checking the checkbox
     */
    checkItem(checked) {
         if(checked == 1){
             return true;
         }
         else {
             return false;
         }
    }, 
    /***
     * These methods are for changing the value of the form data
     */
    added_ssw_sdw(changeValue){
        changeValue == 0 ? this.form.added_ssw_sdw = 1 : this.form.added_ssw_sdw = 0 
    }, 
    added_ssw_mdw(changeValue){
        changeValue == 0 ? this.form.added_ssw_mdw = 1 : this.form.added_ssw_mdw = 0 
    },
    added_msw_sdw(changeValue){
        changeValue == 0 ? this.form.added_msw_sdw = 1 : this.form.added_msw_sdw = 0 
    }, 
    added_msw_mdw(changeValue){
        changeValue == 0 ? this.form.added_msw_mdw = 1 : this.form.added_msw_mdw = 0 
    }, 
    deducted_sdw_ssw(changeValue){
        changeValue == 0 ? this.form.deducted_sdw_ssw = 1 : this.form.deducted_sdw_ssw = 0 
    },  
    deducted_sdw_msw(changeValue){
        changeValue == 0 ? this.form.deducted_sdw_msw = 1 : this.form.deducted_sdw_msw = 0 
    },   
    deducted_mdw_ssw(changeValue){
        changeValue == 0 ? this.form.deducted_mdw_ssw  = 1 : this.form.deducted_mdw_ssw  = 0 
    },    
    deducted_mdw_msw(changeValue){
        changeValue == 0 ? this.form.deducted_mdw_msw  = 1 : this.form.deducted_mdw_msw  = 0 
    },    
    updateDetailsBehavior() {
         console.log("soon");
    }

},

  
created(){
    this.showDetailsAndBehavior(); 
 
}

}
</script>

<style>

</style>