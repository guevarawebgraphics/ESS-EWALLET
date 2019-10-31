<?php

namespace App\Models\WalletAccount;

use Illuminate\Database\Eloquent\Model;

class wallet_amount_limits extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wallet_amount_limits';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
