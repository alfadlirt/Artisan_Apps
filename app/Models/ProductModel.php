<?php

namespace APP\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'prd_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'slug', 
        'slr_id',
        'ktg_id', 
        'name', 
        'description', 
        'global_price_min', 
        'global_price_max', 
        'display_price', 
        'status', 
        'is_discount', 
        'created_date', 
        'created_by',
        'modified_date', 
        'modified_by'
    ];
    
}
