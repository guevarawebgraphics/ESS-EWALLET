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
        $approval = Prefund::get();
        return $approval;
    }
}
