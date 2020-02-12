window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);
// Logged In User
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
      beforeEnter: (requireLogin, checkAdmin)
    },
    { 
      path: '/createwalletaccount', 
      component: require('../components/WalletAccounts/CreateWalletAccount.vue').default, 
      name: 'Create Wallet Account',
      beforeEnter: (requireLogin, checkAdmin)
    },
    { 
      path: '/updatewalletaccount/:id', 
      component: require('../components/WalletAccounts/CreateWalletAccount.vue').default, 
      name: 'Update Wallet Account',
      beforeEnter: (requireLogin, checkAdmin)
    },
    /**
     * @ Service Types
     **/
    { 
      path: '/servicetypes', 
      component: require('../components/WalletServiceTypes/ServiceTypeTable.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    }, 
    { 
      path: '/editservicetype/:id', 
      name: '/test', 
      component: require('../components/WalletServiceTypes/EditServiceType.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },
    { 
      path: '/servicetypesetup/:id', 
      name: '/st-setup', 
      component: require('../components/WalletServiceTypes/ServiceTypeSetUp.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },
    { 
      path: '/createservicetype',
       name: '/st-create-new', 
       component: require('../components/WalletServiceTypes/CreateServiceType.vue').default, 
       beforeEnter: (requireLogin, checkAdmin)
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
      beforeEnter: (requireLogin, checkAdmin)
    },
    { 
      path: '/serviceMatrix', 
      name: 'Service Matrix',
      component: require('../components/ServiceMatrix/ServiceMatrix.vue').default, 
      beforeEnter: (requireLogin),
    },
    /**
     * @ Services  
     */
    {
      path:'/serviceslist/:method_name', 
      name : 'services-list',
      component: require('../components/WalletServices/ServicesListTable.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },
    {
      path:'/createservice/:method_name',
      component: require('../components/WalletServices/CreateWalletServices.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    }, 
    
    {
      path:'/createjointservice',
      name: 'Create Joint Services',
      component: require('../components/WalletServices/JointServices.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },  
    {
      path:'/updateservice/:id/:method_name', 
      name: '/update-service',
      component: require('../components/WalletServices/CreateWalletServices.vue').default, 
      beforeEnter: (requireLogin)
    }, 
    {
      path:'/viewjointservices/:id', 
      name: 'list-joint-services',
      component: require('../components/WalletServices/JointServicesList.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },
    /**
     *@ Wallet Account Type 
     **/
    {
      path:'/walletaccounttype',
      component: require('../components/WalletAccountTypes/WalletAccountType.vue').default, 
      name: 'Wallet Account Type',
      beforeEnter: (requireLogin, checkAdmin)
    },
    /**
     * Service Gateway
     */
    {
      path:'/servicegatewaylist',
      component: require('../components/ServiceGateway/ServiceGatewayTable.vue').default, 
      beforeEnter: (requireLogin, checkAdmin)
    },
    /******************************Employer************************/
    {
      path: '/listwalletaccounts', 
      component: require('../components/ListWalletAccounts/ListWalletAccounts.vue').default, 
      name: 'List of Wallet Accounts',
      beforeEnter: requireLogin
    },
    {
      path: '/walletaccountprofile/:wi', 
      component: require('../components/ListWalletAccounts/WalletAccountProfile.vue').default, 
      name: 'Wallet Account Profile',
      beforeEnter: requireLogin
    },
    {
      path: '/listmerchants/:uid', 
      component: require('../components/ListWalletAccounts/ListMerchants.vue').default, 
      name: 'List of Merchants',
      beforeEnter: requireLogin
    },
    {
      path: '/walletaccountprofile/:wi/ListServices', 
      component: require('../components/ListServices/ListServices.vue').default, 
      name: 'List of Services',
      beforeEnter: requireLogin
    },
    {
      path: '/prefundECPay/:wi',
      component: require('../components/Transactions/PrefundECPay').default,
      name: 'Prefund EC Pay',
      beforeEnter: requireLogin,
      props: { default: true }
    },
    {
      path: '/approval',
      component: require('../components/approval/Approval').default,
      name: 'Approval',
      beforeEnter: (requireLogin,checkMerchant),
    },
    {
      path: '/put-money',
      component: require('../components/Transactions/PutMoney').default,
      name: 'PutMoney',
      beforeEnter: requireLogin,
    },
    /******************************ServiceRates****************************/
    {
      path: '/ServiceRates', 
      component: require('../components/ServiceRates/ServiceRates.vue').default, 
      name: 'Service Rates',
      beforeEnter: requireLogin
    },
    /** List Services */
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
        //window.localStorage.removeItem('user');
        //location.reload();
        localStorage.clear();
        window.location.href="/";
      }
  }

  /**
   * @ Route Guard for Admin 
   **/
  function checkAdmin(to, from, next) {
    let user_type = window.user.user_type_id;
    if (user != null){
      if(user_type !== 1){
        window.location.href="/";
      }
    }
    next(true);
  }

  /**
   * @ Route Guard for Merchant 
   **/
  function checkMerchant(to, from, next) {
    axios.get('/api/auth-gate')
        .then(res => {
          switch (res.data.wallet_account_type) {
            // Admin user
            case 1:
              res.wallet_account_type === 1;
              console.log(res)
              next(true);
              break;
            // Admin Redeem
            case 2:
              res.wallet_account_type === 2;
              next(true);
              break;
          }
        })
        .catch(err => console.log(err))
  }

  /**
   * @ Route Guard for Prepaid Merchant 
   **/
  function checkPrepaidMerchant(to, from, next) {
    let user_type = this.$gate.isPrepaidMerchant();
    if (user != null){
      // check if the current user is Prepaid Merchant
      if(user_type !== 3) {
        window.location.href="/";
      }
    }
    next(true);
  }

export default new VueRouter({
    mode: 'history',
    routes // short for routes: routes
});
