<template>
    <div class="container">
     <div class="col-md-6 offset-md-3 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3 text-center">
                    E-Wallet Service Type  
                </h4>   
                <hr>
                <router-link class="btn btn-primary float-left btn-xs" to="/createservicetype">Create New Service Type <i class="ti-pencil-alt"></i></router-link>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                            <div class="data-tables datatable-dark">
                            <table class="table table-hover table-striped table-responsive text-center" id="table-service-type">
                            <thead>
                                <tr class="th-table">
                                    <th>Service Type Code</th>
                                    <th>Service Type Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="service in services" :key="service.id">
                                    <td>{{service.st_code}}</td>
                                    <td>{{service.st_name}}</td>
                                    <td> <router-link :to="{ name: '/test', params: { id: service.id }}" class="btn btn-primary btn-xs"><i class="ti-pencil-alt"></i> Update</router-link></td>
                                </tr>
                            </tbody>
                            </table> 

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
        data() {
            return {
                services: {},
            }
        },
        methods: {
        loadServices(){
              axios.get("/api/service_type/servicetypetable").then(({ data }) => (this.services = data));
        },
        loadDataTable(){
                setTimeout(function(){ 
                  $('#table-service-type').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    //scrollX: true,
                    "autoWidth": true,
                    lengthChange: true,
                    responsive: true,
                    fixedColumns: false,
                    "order": [1, "desc"]
                  });
                }, 1000);
            }
        },
        created(){ 
             
               this.loadServices(); 
                 this.loadDataTable();
        }
    }
</script>
