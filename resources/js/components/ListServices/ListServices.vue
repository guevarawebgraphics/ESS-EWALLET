<template>
    <div class="container">
     <div id="list-of-service">
         <!-- Box -->
            <div class="box ptb--100">
                <!-- Card -->
                <div class="card shadow-custom">
                    <div class="col-md-12">
                        <h4 class="header-title mt-3 text-center">List of Services - Acct No. {{this.wi}}</h4>   
                        <hr>
                        <div class="float-right">
                            <div class="search-box float-left">
                                <form action="#" @keydown.prevent.enter.self>
                                    <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                                    <i class="ti-search"></i>
                                </form>
                            </div>
                        </div>
                    </div>  
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="data-tables datatable-dark">
                        <!-- Table -->
                            <table class="table table-hover table-striped table-bordered text-center" id="table-services">
                                <thead>
                                    <tr class="th-table">
                                        <th>Service Type </th> 
                                        <th>Service Name</th>
                                        <th>Service Description</th> 
                                        <th>Redeem Wallet No.</th>
                                        <th>Redeem Wallet Acct. Name</th>
                                        <th></th>
                                    </tr>  
                                </thead>
                                <tbody>
                                    <tr v-for="s in ListServices.data" :key="s.id"> 
                                        <td>{{ s.s_wallet_type }}</td>
                                        <td>{{ s.service_name }}</td>
                                        <td>{{ s.service_description }}</td>
                                        <td>{{ s.rwan }}</td>
                                        <td>{{ s.rname }}</td>
                                        <td>
                                            <router-link :to="{ name: 'Prefund EC Pay', params: { wi: s.rwan } }" para class="btn btn-primary btn-xs"> Transact</router-link> 
                                            <router-link :to="{ name: 'PutMoney', params: { wi: s.rwan } }" para class="btn btn-primary btn-xs"> Put Money</router-link> 
                                        </td>   
                                    </tr>  
                                </tbody>
                            </table> 
                        <!-- ./ Table -->
                            <div class="text-center" v-if="this.ListServices.data == 0">
                                <label>No Results found</label>
                            </div>
                        </div>
                    </div>
                    <!-- ./ Card body -->
                                        <!-- Card Footer -->
                    <div class="card-footer bg-white">
                        <!-- Pagination Length -->
                        <div class="float-left">
                            {{ (ListServices.next_page_url == null && ListServices.prev_page_url == null) ? '' : 'Total ' + ListServices.to }}
                            {{ (ListServices.next_page_url == null && ListServices.prev_page_url == null) ? '' : 'of ' + ListServices.total }}
                        </div>
                        <!-- Pagination -->
                        <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                        <pagination class="float-right mb-3" :data="ListServices" @pagination-change-page="getResults">
                            <span slot="prev-nav"><i class="ti-angle-left"></i> Previous</span>
                            <span slot="next-nav">Next <i class="ti-angle-right"></i></span>
                        </pagination>
                        <!-- Pagination -->
                    </div>
                    <!-- ./ Card Footer -->
                </div>
                <!-- ./ Card -->
            </div>
         <!-- ./ Box -->
     </div>
    </div>
</template>

<script>
export default {
data() {
    return {
        message: null,
        typing: null,
        debounce: null,
        ListServices : {},
        wi : this.$route.params.wi
    }
},
methods: {
    getResults(page = 1) {
        axios.get(`/api/service/listservices?page=${page}`)
            .then(response => {
                this.ListServices = response.data;
            });
    },
    getListServices() {
        axios.get('/api/service/listservices')
            .then(response => {
                this.ListServices = response.data;
            })
            .catch((err) => {
                console.log(err);
            })
    },
    debounceSearch(event) {
            this.message = null
            this.typing = 'You are typing'
            clearTimeout(this.debounce)
            this.debounce = setTimeout(() => {
                this.typing = null
                this.message = event.target.value
                //console.log(this.message)
                if(this.message !== "") {
                    axios.get(`/api/service/searchlistofservices/${this.message}`)
                    .then(response => {
                        this.ListServices = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.getListServices()
                }
            }, 600)
        },
},
created(){
    this.getListServices();
}
}
</script>

<style>

</style>