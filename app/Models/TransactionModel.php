<?php

namespace APP\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction_shop';
    protected $primaryKey = 'trs_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'cst_id', 
        'address',
        'expedition',  
        'payment',  
        'discount',  
        'notes',
        'total_paid_price',
        'status',
        'created_date', 
        'created_by'
    ];
    
}
