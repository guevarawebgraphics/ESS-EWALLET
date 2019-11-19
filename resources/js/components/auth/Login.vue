<template>
     <div class="container">
            <div class="login-box ptb--100">
                <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                    <div class="login-form-head">
                        <h4>Elektronik Pitaka</h4>
                    </div>
                    <div class="login-form-body">
                        <div class="form-group">
                        <input v-model="form.username" type="text" name="username"
                            placeholder="Username"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('username') }">
                            <has-error :form="form" field="username"></has-error>
                        </div>
                        <div class="form-group">
                        <input v-model="form.password" type="password" name="password"
                            placeholder="Password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
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
                   console.log(data);
                   window.localStorage.setItem('user', JSON.stringify(this.form.username));
                   window.location.href = "/dashboard"
            })
            .catch(() => {
                console.clear();
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
</style>