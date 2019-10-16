<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
            <div class="col-md-4">
              
            </div>
                <h4 class="header-title mt-3">E-Wallet Service Type</h4>
                <div class="data-tables datatable-dark">
                <table class="table table-hover" id="table-service-type">
                <thead>
                    <tr>
                        <th>Service Type Code</th>
                        <th>Service Type Name</th>
                        <th>Action</th>
                </tr>
                </thead>
                <tbody>
                       <tr v-for="service in services" :key="service.id">
                        <td>{{service.title}}</td>
                        <td>{{service.body}}</td>
                        <td>   <router-link :to="{ name: '/test', params: { id: service.id }}">Link</router-link></td>
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
                "Authorization": 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODA4MFwvYXBpXC9sb2dpbiIsImlhdCI6MTU3MTE5MDA3OCwiZXhwIjoxNTcxMjc2NDc4LCJuYmYiOjE1NzExOTAwNzgsImp0aSI6Ik5GTXZXZXBZUkdITUo5bjYiLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.ZGuPAHxAkpRWL49VyVy4zJED88_mi6uijIoQArP_Lhw',
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
               this.loadDataTable();
               this.loadServices();
        }
    }
</script>
