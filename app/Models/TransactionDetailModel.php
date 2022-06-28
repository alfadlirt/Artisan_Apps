<?php

namespace APP\Models;

use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_shop_dtl';
    protected $primaryKey = 'trs_dtl_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'trs_id', 
        'prd_id', 
        'prd_dtl_id', 
        'qty', 
        'original_price', 
        'paid_price', 
        'subtotal', 
        'created_date', 
        'created_by'
    ];
    
}
