<?php

namespace APP\Models;

use CodeIgniter\Model;

class ProductPicModel extends Model
{
    protected $table = 'product_pic';
    protected $primaryKey = 'prd_pic_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'prd_id', 
        'pic_data', 
        'is_main_pic'
    ];
    
}
