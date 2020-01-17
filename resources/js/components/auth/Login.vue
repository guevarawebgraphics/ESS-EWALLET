<template>
     <div class="container">
            <div class="login-box ptb--100">
                <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                    <div class="login-form-head single-report" id="form-header">
                        <div class="s-report-inner pr--20 pt--10 mb-3">
                            <div class="icon icon-background"><i class="ti-wallet"></i></div>
                                <div class="s-report-title d-flex justify-content-between">
                                <!-- content -->
                            </div>
                        </div>
                        <h4 class="text-white">E - Wallet</h4>
                    </div>
                    <div class="login-form-body shadow-custom bg-white">
                        <div class="form-group">
                            <label for="username" :hidden="form.username == ''">Username</label>
                        <input v-model="form.username" type="text" name="username"
                            placeholder="Username"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('username') }" id="username">
                            <has-error :form="form" field="username"></has-error>
                            <p v-if="status != null" class="text-danger" id="err-msg">These credentials do not match our records</p>
                        </div>
                        <div class="form-group">
                            <label for="password" :hidden="form.password == ''">Password</label>
                        <input v-model="form.password" type="password" name="password"
                            placeholder="Password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Login <i class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
    export default {
       data() {
           return {
               user: window.user,
               status: null,
               form: new Form({
                   username: '',
                   password: '',
                   remember: false
               })
           }
       },

       methods: {
           login () {
               this.form.post('/login')
               .then(({ data }) => { 
                   if(data.status != '401'){
                       console.log(data);
                       window.localStorage.setItem('user', JSON.stringify(this.form.username));
                    //    window.location.href = "/dashboard"
                       this.$router.go('/dashboard')
                   }
                   else {
                       console.clear()
                       $('#username').addClass('is-invalid')
                       this.status = data.status;
                   }
                })
                .catch((err) => {
                    console.clear()
                });
           }
       },
       created(){
           if(this.user){
               this.$router.push('/dashboard')
           }
       }
    }
</script>

<style scoped>
input {
    width: 100%;
    height: 40px;
    border: 1px solid #d9dadc;
    border-radius: 0;
    background-color: #fff;
    background-image: none;
}

#form-header {
    background-color: #504F60 !important;
}

#err-msg {
    line-height: 1,5;
    font-size: 14px;
}
</style>