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
                <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" v-model="form.service_code"   v-validate="'required'"  name="service_type_code" placeholder="Code" disabled>
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3"  v-model="form.service_name" v-on:change="validation()" v-validate="'required'"  name="service_type_name"  placeholder="Name">
                <p class="alert text=danger" v-if="errors.has('service_type_name')"> {{errors.first('service_type_name')}} </p> 
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description</label>
                <div class="col-sm-10">
                <input type="text" class="form-control mb-4 col-sm-4" id="inputEmail3" v-model="form.service_description" v-on:change="validation()" v-validate="'required'"  name="service_type_description" placeholder="Description">
                   <p class="alert text=danger" v-if="errors.has('service_type_description')"> {{errors.first('service_type_description')}} </p> 
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
           <!-- <form>
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
            --> 
                    <form>
            <ul class="list-group list-group-flush"> 
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_ssw_sdw" v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single source wallet, added to single destination wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_ssw_mdw" v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single source wallet, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_msw_sdw" v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to single destination wallet</label>
                </div>
            </li> 
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="added_msw_mdw" v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple source wallets, added to multiple destination wallets</label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_sdw_ssw" v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer intiated in single destination wallets, deducted from single source wallet</label>
                </div> 
             </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_sdw_msw"  v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in single destination wallet, deducted from multiple source wallets</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1" value="deducted_mdw_ssw"  v-model="form.behavior_value">
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from single source wallet</label>
                </div> 
            </li>
            <li class="list-group-item">
                <div class="form-check custom-control">
                    <input type="radio" class="form-check-input" id="exampleCheck1"  value="deducted_mdw_msw" v-model="form.behavior_value"> 
                    <label class="form-check-label" for="exampleCheck1">Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets</label>
                </div>
            </li>
            </ul>
        
            </form> 
                      </div> 
                     <router-link :to="{ name: '/st-setup', params: { id: id_value }}" class="btn btn-primary float-right btn-lg btn-custom" @click.native="updateDetailsBehavior()" v-if="errors.items.length == 0">Save & Next</router-link> 
                     <button type="button" class="btn btn-primary float-right btn-lg btn-custom" v-on:click="showToast()" v-else>Save & Next  </button>
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
        validate : true,
        DetailsBehavior : [],
        form : new Form({
        id: this.$route.params.id,
        service_code : null,
        service_name : null,
        service_description : null,
        behavior_value : null,
      /*  added_ssw_sdw : null,
        added_ssw_mdw : null,
        added_msw_sdw : null,
        added_msw_mdw : null,
        deducted_sdw_ssw : null,
        deducted_sdw_msw : null,
        deducted_mdw_ssw : null,
        deducted_mdw_msw : null,*/
        }), 
    }

},
methods : {
    /**
     * For inserting the response data into form data
     */
    showDetailsAndBehavior() {
            axios.get('/api/service_type/behavior/'+this.id_value)
                .then(response => {
                    this.DetailsBehavior = response.data; 
                    this.form.service_code = response.data['st_code'];
                    this.form.service_name = response.data['st_name'];
                    this.form.service_description = response.data['st_description']; 
                    this.form.behavior_value = response.data['behavior_value']; 
                  /* this.form.added_ssw_sdw =response.data['added_ssw_sdw'];
                    this.form.added_ssw_mdw = response.data['added_ssw_mdw'];
                    this.form.added_msw_sdw = response.data['added_msw_sdw'];
                    this.form.added_msw_mdw = response.data['added_msw_mdw'];
                    this.form.deducted_sdw_ssw = response.data['deducted_sdw_ssw'];
                    this.form.deducted_sdw_msw = response.data['deducted_sdw_msw']; 
                    this.form.deducted_mdw_ssw = response.data['deducted_mdw_ssw']; 
                    this.form.deducted_mdw_msw =response.data['deducted_mdw_msw']; */ 
                    this.form.behavior_value = response.data['behavior_value']; 

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
    validation(){
        if(this.form.service_name != null || this.form.service_description != null){
                    this.$validator.validateAll().then(result => {
                            if (result) {
                                this.validate == true;
                            return; 
                                
                            } 
                            else {
                                this.validate == false;
                                console.log('has error');
                            }
                    });
        }
        else {
            console.log("true");
        }
    },
    /***
     * These methods are for changing the value of the form data
     */
   /* added_ssw_sdw(changeValue){
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
    */
    updateDetailsBehavior() {
        this.form.put('/api/service_type/updateservicetype/'+ this.form.id)
        .then((response) =>{
           
        })
        .catch(() => {
            console.log('rrrr')
        })
    }, 
    showToast(){
            toast.fire({
                              type: 'warning',
                              title: 'Please fill empty fields'
                      })
    }
},

  
created(){
    this.showDetailsAndBehavior(); 
 
}

}
</script>

<style>

</style>