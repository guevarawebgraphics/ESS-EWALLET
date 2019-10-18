<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
        
         
                <h4 class="header-title mt-3">E-Wallet Service Type  
                        <router-link class="btn btn-primary float-right btn-custom" to="/createservicetype">Create New Service Type <i class="ti-arrow-right"></i></router-link>
                </h4>   
            
            </div>  
            <div class="card-body">
     
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-service-type">
                <thead>
                    <tr class="th-table">
                        <th>Service Type Code</th>
                        <th>Service Type Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                       <tr v-for="service in services" :key="service.id">
                        <td>{{service.title}}</td>
                        <td>{{service.body}}</td>
                        <td> <router-link :to="{ name: '/test', params: { id: service.id }}" class="btn btn-primary btn-custom">Update</router-link></td>
                    </tr>
                </tbody>
                </table> 

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
                services: {},
            }
        },
        methods: {
        loadServices(){
             axios({
                method: 'get',
                url: 'https://jsonplaceholder.typicode.com/posts/',
                dataType: 'json',
                contentType: 'application/json',
                secure: true,
                headers: {
                "Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU3MTIwMzk1MCwiZXhwIjoxNTcxMjkwMzUwLCJuYmYiOjE1NzEyMDM5NTAsImp0aSI6IlRRSVRjdlJBWVAxOHB6TjEiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.K0Hv250k94ksZl_ba3V6M2pIIrKsfoNKNpuIJ6cWepk',
                },
            })
            .then(({ data }) => (this.services = data));
            },
        loadDataTable(){
                setTimeout(function(){ 
                  $('#table-service-type').DataTable();
                }, 1000);
            }
        },
        created(){ 
             
               this.loadServices(); 
                 this.loadDataTable();
        }
    }
</script>
