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

    /**
     * @ show approval transaction 
     **/
    public function showApprovalTransaction()
    {
        return response()->json($this->approval->showApprovalTransaction());
    }


    /**
     * @ search approval transaction
     * @param query 
     **/
    public function searchApprovalTransaction($query)
    {
        return response()->json($this->approval->searchApprovalTransaction($query));
    }
}
