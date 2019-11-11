<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class ServiceAmountLimit extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'service_amount_limit';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
