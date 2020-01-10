<template>
 <!-- sidebar menu area start -->
 <div class="sidebar-menu nav-custom">
        <div class="sidebar-header nav-custom">
            <div class="logo">
            <router-link to="/dashboard"><h6 class="text-white">E-Wallet</h6></router-link>
            </div>
        </div>
        <div class="main-menu side-custom">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu" v-if="user.user_type_id === 1">
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-bell text-blue"></i><span>Notification Template</span></a>
                        </li>
                        <li>
                            <router-link to="/walletaccounttype" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Account Types</span></router-link>
                        </li>
                        <li>
                            <router-link to="/walletaccounts" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Accounts</span></router-link>
                        </li>
                        <li>
                            <router-link to="/servicetypes" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Service Types</span></router-link>
                        </li>
                        <li>
                            <router-link to="/serviceslist/view" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Wallet Services List</span></router-link>
                        </li>
                        <li>
                            <router-link to="/servicegatewaylist" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Prepaid Service Gateway</span></router-link>
                        </li>
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Rates</span></a>
                        </li>
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Admin Reports</span></a>
                        </li>
                        <li>
                            
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-wallet text-blue"></i>
                                <span>Service Matrix</span></a>
                            <ul class="collapse">
                                <li><router-link to="/serviceGroup" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Grouping</span></router-link></li>
                                <li><router-link to="/serviceMatrix" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Service Matrix</span></router-link></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="metismenu" id="menu" v-if="user.user_type_id !== 1">
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Notification Template</span></a>
                        </li>
                        <li>
                            <!-- <router-link to="/listwalletaccounts" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>List of Wallet Accounts</span></router-link> -->
                            <router-link to="/listwalletaccounts" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>List of Wallet Accounts</span></router-link>
                        </li>
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>View Statement</span></a>
                        </li>
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Schedule Trans</span></a>
                        </li>
                        <li>
                            <a href="#dashboard" aria-expanded="true"><i class="ti-wallet text-blue"></i><span>Approvals</span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            user: window.user
        }
    }
}
</script>

<style>

</style>