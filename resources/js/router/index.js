window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);
let user = window.localStorage.getItem('user');

const routes = [
    { 
      path: '/',
      component: require('../components/auth/Login.vue').default
    },
    {
       path: '/login',
       component: require('../components/auth/Login.vue').default
    },
    { 
      path: '/home', 
      component: require('../components/auth/Login.vue').default
    },
    { 
      path: '/dashboard', 
      component: require('../components/General/Dashboard.vue').default, 
      name: 'Dashboard',
      beforeEnter: requireLogin
    },
    /* 
     * @ Wallet Accounts
     */
    { 
      path: '/walletaccounts', 
      component: require('../components/WalletAccounts/WalletAccounts.vue').default, 
      name: 'Wallet Accounts',
      beforeEnter: requireLogin
    },
    { 
      path: '/createwalletaccount', 
      component: require('../components/WalletAccounts/CreateWalletAccount.vue').default, 
      name: 'Create Wallet Account',
      beforeEnter: requireLogin
    },
    { 
      path: '/updatewalletaccount/:id', 
      component: require('../components/WalletAccounts/CreateWalletAccount.vue').default, 
      name: 'Update Wallet Account',
      beforeEnter: requireLogin
    },
    /**
     * @ Service Types
     **/
    { 
      path: '/servicetypes', 
      component: require('../components/WalletServiceTypes/ServiceTypeTable.vue').default, 
      beforeEnter: requireLogin
    }, 
    { 
      path: '/editservicetype/:id', name: '/test', 
      component: require('../components/WalletServiceTypes/EditServiceType.vue').default, 
      beforeEnter: requireLogin
    },
    { 
      path: '/servicetypesetup/:id', 
      name: '/st-setup', 
      component: require('../components/WalletServiceTypes/ServiceTypeSetUp.vue').default, 
      beforeEnter: requireLogin
    },
    { 
      path: '/createservicetype',
       name: '/st-create-new', 
       component: require('../components/WalletServiceTypes/CreateServiceType.vue').default, 
       beforeEnter: requireLogin
    },
    /**
     * @ Error Pages
     **/
    { 
      path: '*', 
      component: require('../components/ErrorPages/404.vue') 
    },
    /**
     * @ Routes For Service Matrix 
     **/
    { 
      path: '/serviceGroup', 
      component: require('../components/ServiceMatrix/ServiceGroup.vue').default, 
      name: 'Service Group',
      beforeEnter: requireLogin
    },
    { 
      path: '/serviceMatrix', 
      name: 'Service Matrix',
      component: require('../components/ServiceMatrix/ServiceMatrix.vue').default, 
      beforeEnter: requireLogin
    },
    /**
     * @ Services  
     */
    {
      path:'/serviceslist',
      component: require('../components/WalletServices/ServicesListTable.vue').default, 
      beforeEnter: requireLogin
    },
    {
      path:'/createservice',
      component: require('../components/WalletServices/CreateWalletServices.vue').default, 
      beforeEnter: requireLogin
    },
    /**
     *@ Wallet Account Type 
     **/
    {
      path:'/walletaccounttype',
      component: require('../components/WalletAccountTypes/WalletAccountType.vue').default, 
      name: 'Wallet Account Type',
      beforeEnter: requireLogin
    },
    /**
     * Service Gateway
     */
    {
      path:'/servicegatewaylist',
      component: require('../components/ServiceGateway/ServiceGatewayTable.vue').default, 
      beforeEnter: requireLogin
    },
    /**
     *@ Return Error 404 Page 
     * @param /* 
     **/
    {
      path:'/*',
      component: require('../components/ErrorPages/404.vue').default
    },

  ]

  /**
   * @ Route Guards
   * Authentication Login 
   **/
  function requireLogin(to, from, next) {
      if (user != null) {
          next(true);
      } else {
        window.localStorage.removeItem('user');
        location.reload();
        window.location.href="/";
      }
  }

export default new VueRouter({
    mode: 'history',
    routes // short for routes: routes
});
