<?php

namespace App\Models\ServiceGateway;

use Illuminate\Database\Eloquent\Model;

class ServiceGateway extends Model
{
    
    /**
      * E-Wallet Connection Database 
      **/
     protected $connection = 'mysql';
     // Guarded
     protected $guarded = [];
     // Table Name
     protected $table = 'service_gateway';
     // Primary Key
     public $primaryKey = 'id';
     // Timestamps
     public $timestamps = true;
}
