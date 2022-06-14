<?php

namespace APP\Models;

use CodeIgniter\Model;

class SellerModel extends Model
{
    protected $table = 'seller';
    protected $primaryKey = 'slr_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'shop_name', 
        'shop_description', 
        'shop_address', 
        'f_name', 
        'l_name', 
        'telp', 
        'email', 
        'usrname',
        'pswrd', 
        'status', 
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by',
        'role', 
        'pic', 
    ];
    
}
