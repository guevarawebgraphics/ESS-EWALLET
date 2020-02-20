<template>
    <div id="approval">
        <!-- Box -->
        <div class="box col-md-12 ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title mt-3 text-center">Approvals | Transaction Request</h4>
                            <hr>
                            <div class="float-right">
                                <div class="search-box">
                                    <form action="#" @keydown.prevent.enter.self>
                                        <input class="form-control mb-3" @input="debounceSearch" type="text" name="search" placeholder="Search Wallet Account..." required>
                                        <i class="ti-search"></i>
                                    </form>
                                </div>
                            </div>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table table-hover table-striped table-bordered text-center" id="table_id">
                                    <!-- Thead -->
                                    <thead>
                                        <tr class="th-table">
                                            <th>Wallet ID</th>
                                            <th>Amount</th>
                                            <th>Bank</th>
                                            <th>Branch</th>
                                            <th>Account Type</th>
                                            <th>Account Name</th>
                                            <th>Transaction Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- Thead -->
                                    <!-- Tbody -->
                                    <tbody>
                                        <tr v-for="tr in transactionRequest.data" :key="tr.id">
                                            <td>{{ tr.wallet_id }}</td>
                                            <td><span>&#8369;</span> {{ tr.prefund_amount }} </td>
                                            <td>{{ tr.name_of_bank }}</td>
                                            <td>{{ tr.branch }}</td>
                                            <td>{{ tr.account_type }}</td>
                                            <td>{{ tr.account_name }}</td>
                                            <td>{{ tr.transaction_type }}</td>
                                            <th v-if="tr.transaction_status === 0">
                                                <span class="badge badge-secondary">Pending <i class="fa fa-ellipsis-h"></i></span>
                                            </th>
                                            <th v-if="tr.transaction_status === 1">
                                                <span class="badge badge-primary">Approved <i class="fa fa-check-circle"></i></span>
                                            </th>
                                            <td>
                                                <button :disabled="tr.transaction_status === 1" @click="updateTransactionStatus(tr)" class="btn btn-primary btn-sm">
                                                    <i class="ti-thumb-up text-sm"></i>
                                                    Approve
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- ./Tbody -->
                                </table>
                                <!-- ./Table -->
                            <div class="text-center" v-if="this.transactionRequest.data == 0">
                                <label>No Results found</label>
                            </div>
                            <div class="text-center" v-if="transactionRequest.data === undefined">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Row -->
                </div>
                <!-- ./Card body -->
                <!-- Card Footer -->
                <div class="card-footer bg-white">
                    <!-- Pagination Length -->
                    <div class="float-left">
                        {{ (transactionRequest.next_page_url == null && transactionRequest.prev_page_url == null) ? '' : 'Total ' + transactionRequest.to }}
                        {{ (transactionRequest.next_page_url == null && transactionRequest.prev_page_url == null) ? '' : 'of ' + transactionRequest.total }}
                    </div>
                    <!-- Pagination -->
                    <!-- <pagination class="float-right" :data="WalletAccount" @pagination-change-page="getResults"></pagination> -->
                    <pagination class="float-right" :data="transactionRequest" @pagination-change-page="getResults">
                        <span slot="prev-nav"><i class="ti-angle-left"></i>  Previous</span>
                        <span slot="next-nav">Next <i class="ti-angle-right"></i> </span>
                    </pagination>
                    <!-- Pagination -->
                </div>
                <!-- ./ Card Footer -->
            </div>
            <!-- ./Card -->
        </div>
        <!-- ./Box -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: null,
            typing: null,
            debounce: null,
            transactionRequest: {}
        }
    },
    methods: {
        dataTable() {
            setTimeout(function() {
                $('#table_id').dataTable({
                    paging: true,
                    "pageLength": 10,
                    lengthChange: false,
                    scrollY: true,
                    "autoWidth": true,
                    responsive: true,
                    fixedColumns: true,
                    fixedHeaders: true,
                    "ordering": false
                    //"order": [6, "desc"]
                });
            }, 1000);
        },
        getResults(page = 1) {
            axios.get(`/api/approval/showapprovaltransaction?page=${page}`)
                .then(response => {
                    this.transactionRequest = response.data;
                });
        },
        showApprovalTransaction() {
            axios.get('/api/approval/showapprovaltransaction')
            .then(response => this.transactionRequest = response.data)
            .catch(err => console.log(err))
        },
        updateTransactionStatus(transactionData) {
              swal.fire({
                title: `Are you sure? you want to approved this Transaction Prefund Request? ${transactionData['wallet_id']}`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Save'
            }).then((result) => {
                if (result.value) {
                    this.$Progress.start()
                    axios.post(`/api/transaction/updatePrefundStatus/${transactionData['id']}`)
                    .then(response => {
                        if(response.status === 200) {
                            toast.fire({
                                type: 'success',
                                title: 'Transaction has been approved'
                            })
                            this.$Progress.increase(10)
                            this.$Progress.finish()
                            this.showApprovalTransaction()
                        }
                    })
                    .catch(err => this.$Progress.fail())
                }
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
                    axios.get(`/api/approval/searchapprovaltransaction/${this.message}`)
                    .then(response => {
                        this.transactionRequest = response.data;
                    })
                    .catch(err => console.log(err))
                }
                else {
                    this.showApprovalTransaction()
                }
            }, 600)
        }
    },
    created() {
        this.showApprovalTransaction()
    },
    mounted() {
        //this.dataTable()

        console.log('Mounted')
    }
}
</script>

<style>

</style>