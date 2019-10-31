<?php

namespace App\Models\WalletAccount;

use Illuminate\Database\Eloquent\Model;

class wallet_limit_no_transaction extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wallet_limit_no_transaction';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
