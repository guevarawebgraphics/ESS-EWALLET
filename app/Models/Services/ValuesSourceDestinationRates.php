<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class ValuesSourceDestinationRates extends Model
{
        /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'sd_wallet_service_set_up';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
