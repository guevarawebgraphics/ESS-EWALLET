<?php

namespace App\Repositories\Approval;

use DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\Transaction\Prefund;

/**
 * Class ApprovalRepository.
 */
class ApprovalRepository
{
    /**
     * @ Get Approvals
     * @return ApprovalTransactions 
     **/
    public function showApprovalTransaction()
    {
        $approval = Prefund::where('created_by', auth('api')->user()->id)->latest()->paginate(10);
        return $approval;
    }

    /**
     * @ search approval 
     **/
    public function searchApprovalTransaction($query)
    {
        $approval = Prefund::orWhere('prefund_amount', 'LIKE', '%'.$query.'%')
                    ->orWhere('name_of_bank', 'LIKE', '%'.$query.'%')
                    ->orWhere('branch', 'LIKE', '%'.$query.'%')
                    ->orWhere('account_type', 'LIKE', '%'.$query.'%')
                    ->orWhere('account_name', 'LIKE', '%'.$query.'%')
                    ->orWhere('account_no', 'LIKE', '%'.$query.'%')
                    ->orWhere('transaction_type', 'LIKE', '%'.$query.'%')
                    ->latest()
                    ->paginate(10);
        return $approval;
    }
}
