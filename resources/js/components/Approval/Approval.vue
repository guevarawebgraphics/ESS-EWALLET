<template>
    <div id="approval">
        <!-- Box -->
        <div class="box col-md-10 offset-md-1 ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="header-title mt-3 text-center">Approvals | Transaction Request</h4>
                            <hr>
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
                                        <tr v-for="tr in transactionRequest" :key="tr.id">
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
                            </div>
                        </div>
                    </div>
                    <!-- ./Row -->
                </div>
                <!-- ./Card body -->
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
            transactionRequest: []
        }
    },
    methods: {
        dataTable() {
            setTimeout(function() {
                $('#table_id').dataTable({
                    paging: true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    responsive: true,
                    fixedColumns: true,
                    "order": [6, "desc"]
                });
            }, 1000);
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
        }
    },
    created() {
    },
    mounted() {
        this.dataTable()
        this.showApprovalTransaction()
        console.log('Mounted')
    }
}
</script>

<style>

</style>