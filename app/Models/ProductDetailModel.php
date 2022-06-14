<?php

namespace APP\Models;

use CodeIgniter\Model;

class ProductDetailModel extends Model
{
    protected $table = 'product_detail';
    protected $primaryKey = 'prd_dtl_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'prd_id', 
        'variation_name', 
        'price', 
        'discount_price', 
        'stock',
        'status'
    ];
    
}
