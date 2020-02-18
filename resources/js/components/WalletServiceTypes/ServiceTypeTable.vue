<template>
    <div class="serviceType">
     <div class="col-md-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3 text-center">
                    E-Wallet Service Type  
                </h4>   
                <hr>
                <router-link class="btn btn-primary float-left btn-xs" to="/createservicetype">Create New Service Type <i class="ti-pencil-alt"></i></router-link>
                <div class="float-right">
                    <div class="search-box">
                        <form action="#" @keydown.prevent.enter.self>
                            <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                            <div class="data-tables table-responsive datatable-dark">
                            <table class="table table-hover table-bordered table-striped text-center" id="table-service-type">
                            <thead>
                                <tr class="th-table">
                                    <th>Service Type Code</th>
                                    <th>Service Type Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody :hidden="typing">
                                <tr v-for="service in services.data" :key="service.id">
                                    <td>{{service.st_code}}</td>
                                    <td>{{service.st_name}}</td>
                                    <td> <router-link :to="{ name: '/test', params: { id: service.id }}" class="btn btn-primary btn-xs"><i class="ti-pencil-alt"></i> Update</router-link></td>
                                </tr>
                            </tbody>
                            </table> 
                        <div class="text-center" v-if="this.services.data == 0 && !typing">
                            <label>No Results found</label>
                        </div>

                        <div class="text-center" v-if="services.data === undefined || typing">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                        </div>

                        </div>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer bg-white">
                        <!-- Pagination Length -->
                        <div class="float-left">
                            {{ (services.next_page_url == null && services.prev_page_url == null) ? '' : 'Total ' + services.to }}
                            {{ (services.next_page_url == null && services.prev_page_url == null) ? '' : 'of ' + services.total }}
                        </div>
                        <!-- Pagination -->
                        <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                        <pagination class="float-right mb-3" :data="services" @pagination-change-page="getResults">
                            <span slot="prev-nav"><i class="ti-angle-left"></i> Previous</span>
                            <span slot="next-nav">Next <i class="ti-angle-right"></i></span>
                        </pagination>
                        <!-- Pagination -->
                    </div>
                    <!-- ./ Card Footer -->
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
                query: null,
                typing: false,
                debounce: null,
                services: {},
            }
        },
        methods: {
        getResults(page = 1) {
            axios.get(`/api/service_type/showServiceTypeDetails?page=${page}`)
                .then(response => {
                    this.services = response.data;
                });
        },
        loadServices(){
              axios.get("/api/service_type/showServiceTypeDetails").then(({ data }) => (this.services = data));
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
        },
        debounceSearch(event) {
            this.query = null
            this.typing = true
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                this.typing = false
                this.query = event.target.value
                //console.log(this.query)
                if(this.query !== "") {
                    axios.get(`api/service_type/searchservicetype/${this.query}`)
                    .then(response => {
                        this.services = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.loadServices()
                }
            }, 600)
        }
        },
        created(){ 
            this.loadServices();
            // this.loadDataTable();
        }
    }
</script>
