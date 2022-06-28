<?php

namespace APP\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'crt_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'cst_id', 
        'prd_id', 
        'prd_dtl_id', 
        'qty', 
        'status', 
        'created_date', 
        'created_by'
    ];
    
}
