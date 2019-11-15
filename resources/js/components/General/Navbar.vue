<template>
      <!-- page title area start -->
    <div class="page-title-area">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <div class="breadcrumbs-area clearfix">
                        <h4 class="page-title pull-left">Dashboard</h4>
                        <ul class="breadcrumbs pull-left">
                            <li><router-link to="/dashboard">Home</router-link></li>
                            <li><span>Dashboard</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right btn-custom">
                    <img class="avatar user-thumb" src="/str_dash/images/author/avatar.png"  alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Admin <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Message</a>
                            <a class="dropdown-item" href="#">Settings</a>
                            <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
                                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- page title area end -->
</template>

<script>
export default {
    data(){
        return {}
    },
    methods: {
        logout(){
            axios.post('/logout')
            .then(res => {
                location.reload();
                window.location.href="/";
            })
            .catch(err => {
                console.log(err)
            })
        }
    },
}
</script>

<style>

</style>