<template>
    <div id="list-merchants">
        <div class="box ptb--100">
            <!-- Card -->
            <div class="card shadow-custom">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Form Group Row -->
                    <div class="form-group row">
                        <!-- Col -->
                        <div class="col-md-12">
                            <h4 class="header-title mt-3">
                                List of Merchants Accounts
                            </h4>
                            <div class="data-tables datatable-dark">
                                <!-- Table -->
                                <table class="table striped text-center" id="table_id">
                                    <!-- Thead -->
                                    <thead>
                                        <tr class="th-table">
                                            <th>Wallet Type</th>
                                            <th>Account Type</th>
                                            <th>Account No.</th>
                                            <th>Account Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <!-- ./ Thead -->
                                    <!-- TBody -->
                                    <tbody>
                                        <tr>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>Test</td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm" href="#Details">Details</a>
                                                <a class="btn btn-secondary btn-sm" href="#ServiceMatrix">Service Matrix</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- ./ Tobody -->
                                </table>
                                <!-- ./ Table -->
                            </div>
                        </div>
                        <!-- ./ Col -->
                    </div>
                    <!-- ./ Card body -->
                </div>
                <!-- ./ Card Body -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
     data(){
         return{}
     },
     methods: {
        datatable(){
            setTimeout(function() {
                $('#table_id').DataTable({
                    "paging": true,
                    "pageLength": 10,
                    scrollY: true,
                    "autoWidth": true,
                    //lengthChange: false,
                    responsive: true,
                    fixedColumns: false,
                    "order": [4, "desc"]
                })
            }, 500);
        },
     },
     created(){
         this.datatable()
     }
}
</script>

<style>

</style>