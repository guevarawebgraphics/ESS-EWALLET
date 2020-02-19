<template>
    <div class="container">
     <div class="col-12 mt-5">
        <div class="card shadow-custom">
            <div class="col-md-12">
                <h4 class="header-title mt-3 text-center">E-Wallet Services </h4>   
                <hr>
                <router-link to="/createservice/create" class="btn btn-primary btn-sm float-left mr-3">Create Solo Services <i class="ti-pencil-alt"></i></router-link>  
                <router-link to="/createjointservice" class="btn btn-primary btn-wallet btn-sm float-left">Create Joint Services <i class="ti-pencil-alt"></i></router-link> 
                <div class="float-right">
                    <div class="search-box" @keydown.prevent.enter.self>
                        <form action="#">
                            <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Services List..." required>
                            <i class="ti-search"></i>
                        </form>
                    </div>
                </div>
            </div>  
            <div class="row">
                <div class="col -md-12">
                    <div class="card-body">
                        <div class="data-tables table-responsive datatable-dark">
                        <table class="table table-hover table-striped table-bordered text-center" id="table-services">
                        <thead>
                            <tr class="th-table">
                                <th>Service Code</th>
                                <th>Service Name</th>
                                <th>Service Type Code</th>
                                <th>Service Type Name</th>
                                <th>Available In Wallet Type</th> 
                                <th>Service Condition</th>
                                <th>Action</th>
                            </tr>  
                        </thead>
                        <tbody>
                            <tr v-for="s in Services.data" :key="s.id"> 
                                <td> 
                                    <p>
                                    {{s.service_code}}  
                                    </p>
                                </td> 
                                <td> 
                                    <p>
                                    {{s.service_name}} 
                                    </p>
                                </td>
                                <td>
                                    <p v-if="s.st_code">
                                    <!-- {{ showServiceType(s.id,s.wallet_condition) }} -->
                                    {{ s.st_code }}
                                    </p>
                                    <p v-if="s.st_code == null">
                                        Joint
                                    </p>
                                </td>
                                <td> 
                                    <p>
                                    -----
                                    </p>
                                </td>
                                <td> 
                                    <p>
                                    {{s.s_wallet_type}}
                                    </p>
                                </td>
                                <td> 
                                    <p>
                                    {{s.wallet_condition}} 
                                    </p>
                                </td>
                                <td> 
                                    <router-link :to="{ name: '/update-service', params: { id: s.id, method_name: 'view' }}" class="btn btn-primary" v-if="method_name === 'view' && s.wallet_condition =='solo'"> <i class="ti-pencil-alt"></i> Update</router-link>  
                                    <router-link :to="{ name: 'list-joint-services', params: { id: s.id }}" class="btn btn-primary" v-if="method_name === 'view' && s.wallet_condition =='joint'">View</router-link> 
                                    <router-link :to="{ name: '/update-service', params: { id: s.id, method_name: 'joint' }}" class="btn btn-primary" v-if="method_name === 'joint' && s.wallet_condition === 'solo'" :hidden="checksExistId(s.id)"> Add</router-link> 
                                    <a href="#" class="badge badge-secondary" v-show="checksExistId(s.id) && method_name === 'joint'">TAKEN</a> 
                                    <a href="#" class="badge badge-secondary" v-show="method_name === 'joint' && s.wallet_condition === 'joint'">UNAVAILABLE</a>
                                </td>   
                            </tr>  
                            </tbody>
                        </table> 
                        </div>

                        <div class="text-center" v-if="Services == 0">
                            <label>No Results found</label>
                        </div>

                        <div class="text-center" v-if="Services.data === undefined">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                        </div>

                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer bg-white">
                        <!-- Pagination Length -->
                        <div class="float-left">
                            {{ (Services.next_page_url == null && Services.prev_page_url == null) ? '' : 'Total ' + Services.to }}
                            {{ (Services.next_page_url == null && Services.prev_page_url == null) ? '' : 'of ' + Services.total }}
                        </div>
                        <!-- Pagination -->
                        <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                        <pagination class="float-right" :data="Services" @pagination-change-page="getResults">
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
/**
 * This module is related with other modules to be completed.
 */
 data() {
    return {
        query: null,
        typing: null,
        debounce: null,
        Services : {},
        method_name: this.$route.params.method_name,
        joint_services : JSON.parse(localStorage.getItem('list_services')),
        st_code_get : '',
          
    }

 },
 methods : {
        showDatatable(){
            setTimeout(function(){
                let table = $('#table-services').DataTable({
                    // "searching": false,
                    //"sDom": '<"customcontent">rt<"row"<"col-lg-6" i><"col-lg-6" p>><"clear">',
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: true,
                });
            }, 1000);
        },
        showServices() {
            axios.get('/api/service/getserviceslist')
            .then(response => {
                this.Services = response.data;
                
            })
            .catch(() => {
                console.log("err");
            })
        },
         getResults(page = 1) {
            axios.get(`/api/service/getserviceslist?page=${page}`)
                .then(response => {
                    this.Services = response.data;
                });
        },
        checksExistId(id){
                const joint_services = this.joint_services
                const service = obj => obj.service_id === id;
                if(joint_services !== null){
                    return joint_services.some(service); 
                }
        },
        debounceSearch(event) {
            this.query = null
            this.typing = 'You are typing'
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                this.typing = null
                this.query = event.target.value
                if(this.query !== "") {
                    axios.get(`/api/service/searchservicelist/${this.query}`)
                    .then(response => {
                        this.Services = response.data;
                    })
                    .catch(err => console.log(err))
                   
                }
                else {
                    this.showServices()
                }
            }, 600)
        }
 },
 created() {
    this.showServices()
 }

}
</script>

<style>

</style>