<?php

namespace App\Http\Controllers\Api\Approval;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Use Repository 
 **/
use App\Repositories\Approval\ApprovalRepository;

class ApprovalController extends Controller
{
    /**
     * @ Solid Design
     * @ Repository Implementation 
     **/
    protected $approval;

    /**
     * @ Consctrutor 
     **/
    public function __construct(ApprovalRepository $ApprovalRepository) 
    {
        $this->middleware('auth:api');
        $this->approval = $ApprovalRepository;
    }

    public function showApprovalTransaction()
    {
        $approvalTransaction = $this->approval->showApprovalTransaction();
        return response()->json($approvalTransaction);
    }

    public function searchApprovalTransaction($query)
    {
        return response()->json($this->approval->searchApprovalTransaction($query));
    }
}
