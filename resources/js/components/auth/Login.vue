<template>
     <div class="container">
            <div class="login-box ptb--100">
                <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                    <div class="login-form-head" id="form-header">
                        <h4>E - Wallet</h4>
                    </div>
                    <div class="login-form-body shadow-custom">
                        <div class="form-group">
                        <input v-model="form.username" type="text" name="username"
                            placeholder="Username"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('username') }" id="username">
                            <has-error :form="form" field="username"></has-error>
                            <p v-if="status != null" class="text-danger" id="err-msg">These credentials do not match our records</p>
                        </div>
                        <div class="form-group">
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
                       window.location.href = "/dashboard"
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
    background-color: #283E4A !important;
}

#err-msg {
    line-height: 1,5;
    font-size: 14px;
}
</style>