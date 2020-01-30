import axios from 'axios'

export default class Gate {
    
    constructor(user){
        this.user = user;
    }

    isPrepaidMerchant(){
        return  axios.get('/api/auth-gate')
                .then(res => console.log(res.data.wallet_account_type))
                .catch(err => console.log(err))
    }
}