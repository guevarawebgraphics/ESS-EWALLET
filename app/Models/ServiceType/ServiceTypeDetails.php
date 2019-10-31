<?php

namespace App\Models\ServiceType;

use Illuminate\Database\Eloquent\Model;

class ServiceTypeDetails extends Model
{
       /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'servicetypedetails';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
