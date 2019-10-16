window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);


const routes = [
    { path: '/', component: require('../components/auth/Login.vue').default },
    { path: '/login', component: require('../components/auth/Login.vue').default },
    { path: '/dashboard', component: require('../components/General/Dashboard.vue').default},
    { path: '/walletaccounts', component: require('../components/WalletAccounts/WalletAccounts.vue').default},


    
    { path: '/createwalletaccounts/:id', name: '/test', component: require('../components/WalletAccounts/CreateWalletAccount.vue').default},
    { path: '*', component: require('../components/ErrorPages/404.vue') }
  ]

export default new VueRouter({
    mode: 'history',
    routes // short for routes: routes
});
