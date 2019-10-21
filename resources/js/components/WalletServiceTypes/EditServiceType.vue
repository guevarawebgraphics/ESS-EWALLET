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
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Code">
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Name</label>
                <div class="col-sm-10">
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Name">
                </div>
                </div> 
                <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Service Type Description</label>
                <div class="col-sm-10">
                <input type="email" class="form-control mb-4 col-sm-4" id="inputEmail3" placeholder="Description">
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
            <ul class="list-group list-group-flush"  v-for="behavior in behaviors" :key="behavior.id"> 
            <li class="list-group-item">
                <div class="form-check custom-control custom-checkbox ">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">{{behavior.item}}</label>
                </div> 
            </li>
            </ul>
            </form>
                      </div> 
                     <router-link :to="{ name: '/st-setup', params: { id: id_value }}" class="btn btn-primary float-right btn-lg btn-custom">Next</router-link>
            </div> 
            
            </div> 
            
        </div>
        
    </div>
</template>

<script>
export default {
data(){
    return{
        id_value : this.$route.params.id,
        behaviors :[
        {item :'Balance transfer initiated in single source wallet, added to single destination wallet'}, 
        {item :'Balance transfer intiated in single source wallet, added to multiple destination wallets'},
        {item :'Balance transfer initiated in multiple source wallets, added to single destination wallet'},
        {item :'Balance transfer initiated in multiple source wallets, added to multiple destination wallets'},
        {item :'Balance transfer initiated in multiple destination wallets, deducted from single source wallet'},
        {item :'Balance transfer initiated in single destination wallet, deducted from multiple source wallets'},
        {item :'Balance transfer initiated in multiple destination wallets, deducted from single source wallet'}, 
        {item :'Balance transfer initiated in multiple destination wallets, deducted from multiple source wallets'}
    ]
    }

},
methods : {

},
created(){

}



}
</script>

<style>

</style>