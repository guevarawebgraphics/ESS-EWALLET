window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);


const routes = [
    { path: '/', component: require('../components/auth/Login.vue').default },
    { path: '/login', component: require('../components/auth/Login.vue').default },
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
    { path: '*', component: require('../components/ErrorPages/404.vue') }
  ]

export default new VueRouter({
    mode: 'history',
    routes // short for routes: routes
});
