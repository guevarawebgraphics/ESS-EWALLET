<template>
    <div id="WalletAccountType">
        <!-- Box -->
        <div class="box ptb--100 col-md-12">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Row Table -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right">
                                <div class="search-box float-left">
                                    <form action="#" @keydown.prevent.enter.self>
                                        <input class="form-control" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account Types..." required>
                                        <i class="ti-search"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Col md 12 -->
                        <div class="col-md-12">
                            <!-- <div class="header-title text-center">Wallet Account Types</div> -->
                            <hr>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table table-hover table-bordered table-striped text-center" id="wallet_account_types">
                                    <thead>
                                        <tr class="th-table">
                                            <th>Type Code</th>
                                            <th>Wallet Account Type</th>
                                            <th>Wallet Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="wat in walletAccountTypes.data" :key="wat.id">
                                            <td>{{ wat.type_code}}</td>
                                            <td>{{ wat.wallet_account_type}}</td>
                                            <td>{{ wat.wallet_type }}</td>
                                            <td v-if="wat.status == 1"><div class="badge badge-primary">Active</div></td>
                                            <td v-if="wat.status == 0"><div class="badge badge-info">Disabled</div></td>
                                            <td>
                                                <a class="btn btn-primary btn-xs" href="#EditServiceGroup" @click="editWalletAccountType(wat)">
                                                    <i class="fa fa-edit blue"></i>
                                                    <span>Update</span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- ./ Table -->
                            </div>
                            <div class="text-center" v-if="this.walletAccountTypes.data == 0">
                                <label>No Results found</label>
                            </div>

                            <div class="text-center" v-if="walletAccountTypes.data === undefined">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                            </div>
                        </div>
                        <!-- ./ Col -->
                    </div>
                    <!-- ./ Row Table -->
                    <!-- Row Button -->
                    <!-- <div class="form-group row">
                        <button type="button" class="btn btn-primary mb-3" @click="openModal"><i class="ti-plus text-white"></i> Create New</button>
                    </div> -->
                    <!-- ./Row Button -->
                </div>
                <!-- ./ Card bobdy -->
                <!-- Card Footer -->
                <div class="card-footer bg-white">
                    <!-- Pagination Length -->
                    <div class="float-left">
                        {{ (walletAccountTypes.next_page_url == null && walletAccountTypes.prev_page_url == null) ? '' : 'Total ' + walletAccountTypes.to }}
                        {{ (walletAccountTypes.next_page_url == null && walletAccountTypes.prev_page_url == null) ? '' : 'of ' + walletAccountTypes.total }}
                    </div>
                    <!-- Pagination -->
                    <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                    <pagination class="float-right" :data="walletAccountTypes" @pagination-change-page="getResults">
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
        <!-- Create Wallet Type Account -->
        <div class="modal fade" id="walletAccountType" tabindex="-1" role="dialog" aria-labelledby="walletAccountType" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Wallet Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form -->
                <form @submit.prevent="editmode ? updateWalletType() : storeWalletAccountType()">
                    <!-- <input type="hidden" name="_token" :value="csrf"> -->
                    <div class="modal-body">
                        <div v-if="editmode" class="form-group">
                            <label class="custom-label" for="type_code">Type code</label>
                            <input type="text" v-model="form.type_code"  class="form-control" :class="{ 'is-invalid': form.errors.has('type_code') }" name="type_code" placeholder="Wallet Account Type Code" disabled="true">
                            <has-error :form="form" field="type_code"></has-error>
                        </div>
                        <div class="form-group">
                            <label class="custom-label" for="wallet_account_type">Wallet Account Type</label>
                            <input type="text" v-model="form.wallet_account_type"  class="form-control" :class="{ 'is-invalid': form.errors.has('wallet_account_type') }" name="wallet_account_type"  placeholder="Wallet Account Type">
                            <has-error :form="form" field="wallet_account_type"></has-error>
                        </div>
                        <div v-if="editmode" class="form-group">
                            <label class="custom-label" for="status">Status</label>
                            <select v-model="form.status" class="custom-select">
                                <option selected value="" disabled>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="wallet_type" class="custom-label">Wallet Type</label>
                            <select v-model="form.wallet_type" class="custom-select">
                                <option selected value="" disabled>Select Wallet Type</option>
                                <option value="Admin" v-if="form.wallet_type == 'Admin'">Admin</option>
                                <option value="Credit">Credit</option>
                                <option value="Prepaid">Prepaid</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose"><i class="ti-close"></i> Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-primary" id="btnUpdate">
                            <i class="ti-save"></i>
                             Update
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="updateSpinner"></span>
                        </button>
                        <button v-show="!editmode" type="submit" class="btn btn-primary"><i class="ti-save"></i> Save changes</button>
                    </div>
                </form>
            <!-- ./Form -->
            </div>
        </div>
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
            editmode: false,
            walletAccountTypes: {},
            form: new Form({
                csrf_token: $('meta[name="csrf-token"]').attr('content'),
                id: '',
                type_code: '',
                wallet_account_type: '',
                wallet_type: '',
                status
            })
        }
    },
    methods:{
        datatable() {
            setTimeout(function(){
                $('#wallet_account_types').DataTable({
                    "paging": false,
                    "pageLength": 10,
                    scrollY: false,
                    "autoWidth": false,
                    //lengthChange: false,
                    responsive: false,
                    fixedColumns: true,
                    "ordering": false,
                    // "order": [0, "desc"]
                });
            }, 1000);
        },
        getResults(page = 1) {
            axios.get(`api/walletaccount/showAllWalletAccountType?page=${page}`)
                .then(response => {
                    this.walletAccountTypes = response.data;
                });
        },
        showWalletAccountType()
        {
            axios.get('api/walletaccount/showAllWalletAccountType').then(({ data}) => (this.walletAccountTypes = data));
        },
        editWalletAccountType(wat) {
            this.form.clear()
            this.editmode = true;
            this.form.reset()
            $('#walletAccountType').modal('show')
            this.form.fill(wat)
        },
        openModal() {
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#walletAccountType').modal('show')
        },
        updateWalletType() {
            $('#btnUpdate').attr('disabled', true)
            $('#modalClose').attr('disabled', true)
            $('#updateSpinner').removeAttr('hidden')
            this.$Progress.start()
            this.form.put('api/walletaccount/updateWalletAccountType')
            .then(res => {
                $('#walletAccountType').modal('hide')
                $(document.body).removeAttr('class')
                //$("#wallet_account_types").DataTable().destroy()
                this.showWalletAccountType()
                //this.datatable()
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
                this.$Progress.increase(10)
                this.$Progress.finish()
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#updateSpinner').attr('hidden', true)
            })
            .catch(() => {
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#updateSpinner').attr('hidden', true)
                console.clear()
                this.$Progress.fail()
            })
        },
        storeWalletAccountType() {
            this.$Progress.start()
            this.form.post('api/walletaccount/storeWalletAccountType')
            .then(res => {
                console.log(res)
                $('#walletAccountType').modal('hide')
                $(document.body).removeAttr('class')
                //$("#wallet_account_types").DataTable().destroy()
                this.showWalletAccountType()
                //this.datatable()
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
                this.$Progress.increase(10)
                this.$Progress.finish()
            })
            .catch(() => {
                console.clear()
                this.$Progress.fail()
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
                    axios.get(`api/walletaccount/searchWalletAccountType/${this.message}`)
                    .then(response => {
                        this.walletAccountTypes = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.showWalletAccountType()
                }
            }, 600)
        }
    },
    created(){
        //this.datatable()
        this.showWalletAccountType()
    }
}
</script>

<style scoped>
</style>