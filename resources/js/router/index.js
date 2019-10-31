window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);


const routes = [
    { path: '/', component: require('../components/auth/Login.vue').default },
    { path: '/login', component: require('../components/auth/Login.vue').default },
    { path: '/home', component: require('../components/auth/Login.vue').default },
    { path: '/dashboard', component: require('../components/General/Dashboard.vue').default},
    { path: '/walletaccounts', component: require('../components/WalletAccounts/WalletAccounts.vue').default},
    { path: '/createwalletaccounts', component: require('../components/WalletAccounts/CreateWalletAccount.vue').default},
    /**
     * @ CHUGUG EARPHONES SIRA
     **/
    { path: '/servicetypes', component: require('../components/WalletServiceTypes/ServiceTypeTable.vue').default}, 
    { path: '/editservicetype/:id', name: '/test', component: require('../components/WalletServiceTypes/EditServiceType.vue').default},
    { path: '/servicetypesetup/:id', name: '/st-setup', component: require('../components/WalletServiceTypes/ServiceTypeSetUp.vue').default},
    { path: '/createservicetype', name: '/st-create-new', component: require('../components/WalletServiceTypes/CreateServiceType.vue').default},
    { path: '*', component: require('../components/ErrorPages/404.vue') },
    /**
     * @ Routes For Service Matrix 
     **/
    { path: '/serviceGroup', component: require('../components/ServiceMatrix/ServiceGroup.vue').default},
    { path: '/serviceMatrix', component: require('../components/ServiceMatrix/ServiceMatrix.vue').default},
    /**
     * @ Services  
     */
    {path:'/serviceslist',component: require('../components/WalletServices/ServicesListTable.vue').default},
    {path:'/createservice',component: require('../components/WalletServices/CreateWalletServices.vue').default},
    /**
     *@ Wallet Account Type 
     **/
    {path:'/walletaccounttype',component: require('../components/WalletAccountTypes/WalletAccountType.vue').default},
    /**
     * Service Gateway
     */
    {path:'/servicegatewaylist',component: require('../components/ServiceGateway/ServiceGatewayTable.vue').default},
    /**
     *@ Return Error 404 Page 
     * @param /* 
     **/
    {path:'/*',component: require('../components/ErrorPages/404.vue').default},

  ]

export default new VueRouter({
    mode: 'history',
    routes // short for routes: routes
});
