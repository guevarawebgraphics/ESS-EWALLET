<?php

namespace App\Models\Services;

use Illuminate\Database\Eloquent\Model;

class WDetails extends Model
{
     /**
     * E-Wallet Connection Database 
     **/
    protected $connection = 'mysql';
    // Guarded
    protected $guarded = [];
    // Table Name
    protected $table = 'wdetails';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
