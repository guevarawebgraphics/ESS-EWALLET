<?php

namespace App\Models\WalletAccountType;

use Illuminate\Database\Eloquent\Model;

class wallet_account_type extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wallet_account_types';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
