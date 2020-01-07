<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class ServiceTypeDetailsBasetable extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'service_type_details_basetable';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

}
