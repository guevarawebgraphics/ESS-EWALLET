<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class JointService extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'joint_services';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
