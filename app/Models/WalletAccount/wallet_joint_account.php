<?php

namespace App\Models\WalletAccount;

use Illuminate\Database\Eloquent\Model;

class wallet_joint_account extends Model
{
    /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wallet_joint_account';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
