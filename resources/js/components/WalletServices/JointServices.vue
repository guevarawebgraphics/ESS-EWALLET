<template>
       <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12"> 
                  <h4 class="header-title mt-3 text-center">  Joint Services </h4>   
            </div>   
            <div class="card-body"> 
       
            <div class="data-tables datatable-dark">  
              <form>  
              <div class="form-group row">

              </div>
              </form>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
        form : new form({
            original_wallet_type : '', 
            original_service_code : '',
            original_service_name : '',
            original_service_description : '',

        }),
    }
},
methods : {

},
created () {

}
}
</script>

<style>

</style>