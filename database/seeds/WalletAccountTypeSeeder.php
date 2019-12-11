<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
// Use Models Here
use App\Models\WalletAccountType\wallet_account_type;

class WalletAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wat = array(
            // Admin
            array(
                'id' => 1,
                'type_code' => 'AW01',
                'wallet_account_type' => 'Admin User',
                'wallet_type' => 'Admin'
            ),
            array(
                'id' => 2,
                'type_code' => 'AW02',
                'wallet_account_type' => 'Admin Redeem',
                'wallet_type' => 'Admin'
            ),
            // Prepaid
            array(
                'id' => 3,
                'type_code' => 'PW01',
                'wallet_account_type' => 'Prepaid Merchant ',
                'wallet_type' => 'Prepaid'
            ),
            array(
                'id' => 4,
                'type_code' => 'PW02',
                'wallet_account_type' => 'Prepaid Branch',
                'wallet_type' => 'Prepaid'
            ),
            array(
                'id' => 5,
                'type_code' => 'PW03',
                'wallet_account_type' => 'Prepaid User',
                'wallet_type' => 'Prepaid'
            ),
            // Credit
            array(
                'id' => 6,
                'type_code' => 'CW01',
                'wallet_account_type' => 'Lender Main',
                'wallet_type' => 'Credit'
            ),
            array(
                'id' => 7,
                'type_code' => 'CW02',
                'wallet_account_type' => 'Lender Branch',
                'wallet_type' => 'Credit'
            ),
            array(
                'id' => 8,
                'type_code' => 'CW03',
                'wallet_account_type' => 'Credit User',
                'wallet_type' => 'Credit'
            )
        );
        foreach($wat as $data) {
            /**
             * @ Create Wallet Account Types For Default
             **/
            $WalletAccountTypes = wallet_account_type::create([
                        'id' => $data['id'],
                        'type_code' => $data['type_code'],
                        'wallet_account_type' => $data['wallet_account_type'],
                        'wallet_type' => $data['wallet_type'],
                        'created_by' => 1,
                        'updated_by' => 1,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
            ]);
        }
    }
}
