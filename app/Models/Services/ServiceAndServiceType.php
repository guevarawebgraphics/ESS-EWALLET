<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class ServiceAndServiceType extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'service_and_servicetype';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
