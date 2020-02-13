<template>
    <div>
        <a class="btn btn-primary btn-sm whiteColor" @click="openModal()">Create Service Rates <i class="ti-pencil-alt"></i></a>
        <br>
        <br>
        <h2>{{ name }}</h2>
            <input type="text" v-model="name" class="test" id="test">
            <h2 v-if="name != ''">Test</h2>

            <ul v-for="items in ServiceRates.data" :key="items.id">
                <li>{{ items.id}}</li>
                <li>{{ items.title}}</li>
                <li>{{ items.desc}}</li>
                <li>{{ items.created_at}}</li>
                <li>
                    <a class="btn btn-primary btn-xs" href="#EditServiceRates" @click="editServiceRates(items)">
                        <i class="fa fa-edit blue"></i>
                        <span>Update</span>
                    </a> 
                </li>
            </ul>

        <div class="text-center" v-if="ServiceRates.data === undefined">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="updateSpinner"></span>
        </div>


        <!-- Service Rate -->
        <div class="modal fade" id="ServiceRateModal" tabindex="-1" role="dialog" aria-labelledby="ServiceRateModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Service Rate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Form -->
                <form @submit.prevent="editmode ? updateServiceRates() : storeServiceRates()">
                    <!-- <input type="hidden" name="_token" :value="csrf"> -->
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="custom-label" for="title">Title</label>
                            <input type="text" v-model="form.title"  class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" name="title" placeholder="Service Rates Title">
                            <has-error :form="form" field="title"></has-error>
                        </div>

                        <div class="form-group">
                            <label class="custom-label" for="desc">Desc</label>
                            <input type="text" v-model="form.desc"  class="form-control" :class="{ 'is-invalid': form.errors.has('desc') }" name="desc" placeholder="Service Rates Desc">
                            <has-error :form="form" field="desc"></has-error>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modalClose"><i class="ti-close"></i> Close</button>
                        <button v-show="editmode" type="submit" class="btn btn-primary" id="btnUpdate">
                            <i class="ti-save"></i>
                             Update
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden="true" id="updateSpinner"></span>
                        </button>
                        <button v-show="!editmode" type="submit" id="btnSave" class="btn btn-primary"><i class="ti-save"></i> Save changes</button>
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
            name: '',
            editmode: false,
            ServiceRates:{},
            form: new Form({
                csrf_token: $('meta[name="csrf-token"]').attr('content'),
                id: '',
                title: '',
                desc: '',
                created_at: '',
                updated_at: '',
            })
        }
    },
    methods: {
        showServiceRates()
        {
            axios.get('api/servicerates/showAllServiceRates').then(({ data}) => (this.ServiceRates = data));
        },
        openModal() {
            this.form.clear()
            this.editmode = false;
            this.form.reset();
            $('#ServiceRateModal').modal('show')
        },
        editServiceRates(items) {
            this.form.clear()
            this.editmode = true;
            this.form.reset()
            $('#ServiceRateModal').modal('show')
            this.form.fill(items)
        },
        updateServiceRates(){
            $( '#btnUpdate').attr('disabled', true)
            $('#modalClose').attr('disabled', true)
            $('#Spinner').removeAttr('hidden')
            this.$Progress.start()
            this.form.post('/api/servicerates/updateServiceRates')
            .then((response) => {
                this.$Progress.increase(10)
                this.$Progress.finish()
                 $('#ServiceRateModal').modal('hide')
                $(document.body).removeAttr('class')
                this.showServiceRates()
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#Spinner').attr('hidden', true)
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
            })
            .catch((err) => {
                console.log(err)
                this.$Progress.fail()
                console.clear()
                $('#btnUpdate').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#Spinner').attr('hidden', true)
            }) 
        },
        storeServiceRates(){
            $('#btnSave').attr('disabled', true)
            $('#modalClose').attr('disabled', true)
            $('#saveSpinner').removeAttr('hidden')
            this.$Progress.start()
            this.form.post('api/servicerates/storeServiceRates')
            .then((response) => {
                this.$Progress.increase(10)
                this.$Progress.finish()
                $('#ServiceRateModal').modal('hide')
                $(document.body).removeAttr('class')
                this.showServiceRates()
                $('#btnSave').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#saveSpinner').attr('hidden', true)
                toast.fire({
                    type: 'success',
                    title: 'Saved!'
                })
                
            })
            .catch(() => {
                this.$Progress.fail()
                console.clear()
                $('#btnSave').removeAttr('disabled')
                $('#modalClose').removeAttr('disabled')
                $('#saveSpinner').attr('hidden', true)
            })
        },
    },
    created() {
        this.showServiceRates()
        console.log(this.name)
    }
}
</script>

<style scoped>
.whiteColor{
    color: #fff!important;
}
</style>