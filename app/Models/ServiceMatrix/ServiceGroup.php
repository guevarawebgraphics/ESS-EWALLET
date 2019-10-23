<?php

namespace App\Models\ServiceMatrix;

use Illuminate\Database\Eloquent\Model;

class ServiceGroup extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'service_grouping';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
