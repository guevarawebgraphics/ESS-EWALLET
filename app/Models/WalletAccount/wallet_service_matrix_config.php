<?php

namespace App\Models\WalletAccount;

use Illuminate\Database\Eloquent\Model;

class wallet_service_matrix_config extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wallet_service_matrix_config';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
