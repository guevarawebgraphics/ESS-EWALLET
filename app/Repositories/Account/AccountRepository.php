<?php

namespace App\Repositories\Account;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\User;
use Illuminate\Http\Request;
/**
 * Class AccountRepository.
 */
class AccountRepository
{
    /**
     * @return string
     * @ mysq2 (ESS Database)
     * @ Get All Account
     */
    public function get_all_account($essid)
    {
        $Account = DB::connection('mysql2')
                    ->table('ess_basetable')
                    ->join('users', 'ess_basetable.ess_id', '=', 'users.username')
                    ->join('employer', 'employer.id', 'users.employer_id')
                    ->select(
                        'users.username',
                        'employer.business_name',
                        'employer.accountname',
                        'employer.tin',
                        'employer.sss',
                        'employer.phic',
                        'employer.contact_email',
                        'employer.address_unit',
                        'employer.address_country',
                        'employer.address_town',
                        'employer.address_cityprovince',
                        'employer.address_barangay',
                        'employer.address_zipcode',
                        )
                    ->where('ess_basetable.ess_id', '=', $essid)
                    ->get();
        return $Account;
    }
}
