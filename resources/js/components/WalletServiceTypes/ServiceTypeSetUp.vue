<template>
    <div>
        <div class="col-lg-12 mt-5">
            <div class="card">
            <div class="card-body">
            <div class="col-sm-5">
            <h4 class="header-title">List of Services using this service type</h4>
                    <div class="single-table">
                    <div class="table-responsive">
                    <table class="table table-bordered text-center">
                    <thead class="text-uppercase">
                    <tr>
                        <th scope="col">Service Code</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Service Gateway</th>
                    </tr>
                    </thead>
                    <tbody> 
                    <tr v-for="Service in Services" :key="Service.id">
                        <th scope="row">{{Service.service_code}}</th>
                        <td>{{Service.service_name}}</td>
                        <td>{{Service.gateway_name}}</td>
                    </tr>
                    </tbody>
                    </table>
                    </div>
                    </div>
            </div> 
            
           
            <!-- --> 
                    <div class="col-md-6 mt-5">
                
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Acknowledgement Template:  </label>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                            </div>   
                        </div> 
                    </li>
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Approval Template:</label>
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                            </div> 
                        </div> 
                    </li>
                    <li class="list-group-item">
                        <div class="form-check custom-control custom-checkbox ">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Transaction Confirmation Template:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile03">
                            <label class="custom-file-label" for="inputGroupFile03">Choose file</label>
                        </div> 
                        </div> 
                    </li>

                    </ul> 
                        <button type="button" class="btn btn-flat btn-primary btn-lg mb-5 mt-3 float-right btn-custom" v-on:click="saveServiceType"> Save Service Type</button>
                    </div> 
                    
            </div> 
            
            </div> 
            
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {
        Services : {},
        showList: true,
        id: this.$route.params.id,
    }
},
methods: {
    showServices(){
            axios.get('/api/showservices/' +this.id) 
            .then((response) => {
                this.Services = response.data;
                if(response.data.length > 0 ){
                    this.Services = response.data;
                    console.log('true');
                }
                else {
                    

                }
            })
            .catch(() => {

            })
    }, 
    saveServiceType(){
            this.$router.push('/servicetypes');
            console.log("ho");
    },

},
created() {
    this.showServices();
}
}
</script>

<style>

</style>