<?php

namespace App\Repositories\Account;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\WalletAccount\wallet_account;

use DB;
use Keygen;
use App\User;
use Illuminate\Http\Request;
/**
 * Class AccountRepository.
 */
class AccountRepository
{
    /**
     * @ connection
     **/
    protected $connection;
    /**
     * @ constructor 
     **/
    public function __construct()
    {
        // ESS Connection
        $this->connection = DB::connection('mysql2');
    }

    /**
     * @return string
     * @ mysq2 (ESS Database)
     * @ Get All Account
     */
    public function showAccountViaEssId($essid)
    {
        $user = auth('api')->user();
        /**
         * @ check 
         **/
        $check = $this->connection
                    ->table('ess_basetable')
                    ->where('ess_id', '=', $essid)
                    ->select('user_type_id')
                    ->first();
        
        if(!empty($check)){
            /**
             * @ Check if Admin 
             **/
            if($user->user_type_id === 1){
                 /**
                 * @  check if employer
                **/
                if($check->user_type_id == 3){
                    $employer = $this->connection
                            ->table('ess_basetable')
                            ->join('users', 'ess_basetable.ess_id', '=', 'users.username')
                            //->join('employee', 'employer_and_employee.employer_id', 'employee.id')
                            ->join('employer', 'employer.id', 'users.employer_id')
                            ->join('refprovince', 'employer.address_cityprovince', '=', 'refprovince.provCode')
                            ->join('refcitymun', 'employer.address_town', '=', 'refcitymun.citymunCode')
                            ->join('refbrgy', 'employer.address_barangay', '=', 'refbrgy.id') 
                            ->select(
                                'users.username',
                                'employer.business_name',
                                'employer.accountname',
                                'employer.tin',
                                'employer.sss',
                                'employer.phic',
                                'employer.contact_email as email_add',
                                'employer.address_unit',
                                'employer.address_country',
                                'employer.address_town',
                                'employer.address_cityprovince',
                                'employer.address_barangay',
                                'employer.address_zipcode',
                                'refprovince.provDesc',
                                'refprovince.provCode',
                                'refcitymun.citymunDesc',
                                'refcitymun.citymunCode',
                                'refbrgy.brgyDesc',
                                'refbrgy.id as refbrgy_id',
                                )
                            ->where('ess_basetable.ess_id', '=', $essid)
                            ->get();
                    return $employer;
                }
                
                /**
                 * @ check if employee 
                **/ 
                if($check->user_type_id == 4){
                    $employee = $this->connection
                                ->table('ess_basetable')
                                ->join('users', 'ess_basetable.ess_id', '=', 'users.username')
                                ->join('employee_personal_information', 'ess_basetable.employee_info', '=', 'employee_personal_information.id')
                                ->join('employer_and_employee', 'ess_basetable.ess_id', '=', 'employer_and_employee.ess_id')
                                ->join('refprovince', 'employee_personal_information.province', '=', 'refprovince.provCode')
                                ->join('refcitymun', 'employee_personal_information.citytown', '=', 'refcitymun.citymunCode')
                                ->join('refbrgy', 'employee_personal_information.barangay', '=', 'refbrgy.id')
                                ->join('employer', 'employer_and_employee.employer_id', '=', 'employer.id')   
                                ->select(
                                    'users.username',
                                    'employee_personal_information.lastname',
                                    'employee_personal_information.firstname',
                                    'employee_personal_information.middlename',
                                    'employee_personal_information.suffix',
                                    'employee_personal_information.TIN as tin',
                                    'employee_personal_information.SSSGSIS as sss',
                                    'employee_personal_information.PHIC',
                                    'employee_personal_information.email_add',
                                    'employee_personal_information.birthdate',
                                    'employee_personal_information.country',
                                    'employee_personal_information.address_unit',
                                    'refprovince.provDesc',
                                    'refprovince.provCode',
                                    'refcitymun.citymunDesc',
                                    'refcitymun.citymunCode',
                                    'refbrgy.brgyDesc',
                                    'refbrgy.id as refbrgy_id',
                                    'employer.business_name',
                                    'employer.accountname'
                                )
                                ->where('ess_basetable.ess_id', '=', $essid)
                                ->get();
                    return $employee;

                }
            }
             /**
              * @  check if employer
              **/
             if($check->user_type_id == 3){
                $employer = $this->connection
                        ->table('employer_and_employee')
                        // /->table('ess_basetable')
                        ->join('users', 'employer_and_employee.ess_id', '=', 'users.username')
                        //->join('employee', 'employer_and_employee.employer_id', 'employee.id')
                        ->join('employer', 'employer.id', 'users.employer_id')
                        ->join('refprovince', 'employer.address_cityprovince', '=', 'refprovince.provCode')
                        ->join('refcitymun', 'employer.address_town', '=', 'refcitymun.citymunCode')
                        ->join('refbrgy', 'employer.address_barangay', '=', 'refbrgy.id') 
                        ->select(
                            'users.username',
                            'employer.business_name',
                            'employer.accountname',
                            'employer.tin',
                            'employer.sss',
                            'employer.phic',
                            'employer.contact_email as email_add',
                            'employer.address_unit',
                            'employer.address_country',
                            'employer.address_town',
                            'employer.address_cityprovince',
                            'employer.address_barangay',
                            'employer.address_zipcode',
                            'refprovince.provDesc',
                            'refprovince.provCode',
                            'refcitymun.citymunDesc',
                            'refcitymun.citymunCode',
                            'refbrgy.brgyDesc',
                            'refbrgy.id as refbrgy_id',
                            )
                        ->where('employer_and_employee.ess_id', '=', $essid)
                        ->where('employer_and_employee.employer_id', '=', $user->employer_id)
                        ->get();
                return $employer;
             }
             
             /**
              * @ check if employee 
              **/ 
             if($check->user_type_id == 4){
                $employee = $this->connection
                            ->table('ess_basetable')
                            ->join('users', 'ess_basetable.ess_id', '=', 'users.username')
                            ->join('employee_personal_information', 'ess_basetable.employee_info', '=', 'employee_personal_information.id')
                            ->join('employer_and_employee', 'ess_basetable.ess_id', '=', 'employer_and_employee.ess_id')
                            ->join('refprovince', 'employee_personal_information.province', '=', 'refprovince.provCode')
                            ->join('refcitymun', 'employee_personal_information.citytown', '=', 'refcitymun.citymunCode')
                            ->join('refbrgy', 'employee_personal_information.barangay', '=', 'refbrgy.id')
                            ->join('employer', 'employer_and_employee.employer_id', '=', 'employer.id')   
                            ->select(
                                'users.username',
                                'employee_personal_information.lastname',
                                'employee_personal_information.firstname',
                                'employee_personal_information.middlename',
                                'employee_personal_information.suffix',
                                'employee_personal_information.TIN as tin',
                                'employee_personal_information.SSSGSIS as sss',
                                'employee_personal_information.PHIC',
                                'employee_personal_information.email_add',
                                'employee_personal_information.birthdate',
                                'employee_personal_information.country',
                                'employee_personal_information.address_unit',
                                'refprovince.provDesc',
                                'refprovince.provCode',
                                'refcitymun.citymunDesc',
                                'refcitymun.citymunCode',
                                'refbrgy.brgyDesc',
                                'refbrgy.id as refbrgy_id',
                                'employer.business_name',
                                'employer.accountname'
                            )
                            ->where('ess_basetable.ess_id', '=', $essid)
                            ->where('employer_and_employee.employer_id', '=', $user->employer_id)
                            ->get();
                return $employee;

             }
        }
    }

    /*****************************************************************************
     * Helpers Functions
     * Below Add Helpers Function
     * Securities
     *****************************************************************************/

    /**
     * @ Generate Wallet Account No
     * @return WalletAccountNo
     **/
    public function generateAccountNo()
    {
        $account_no = $this->generateNo();

        /**
         * @ Check if there is existing Wallet Account No 
         * @ Generate a new one if already exists
         **/
        while (wallet_account::where('ess_id', $account_no)->count() > 0) {
            $account_no = $this->generateNo();
        }

        return $account_no;
    }

    /**
     * @ Generate No
     * @return generateNo
     **/
    public function generateNo()
    {
        $account_no = Keygen::length(9)->numeric()->generate(
            function($key) {
                // Add a (-) after every fourth character in the key
                return join('-', str_split($key, 3));
            },
        );

        return $account_no;
        
    }
}
