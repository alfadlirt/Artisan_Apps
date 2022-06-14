<?php

namespace APP\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'ktg_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'ktg_name', 
        'icon_css', 
        'status', 
        'created_date', 
        'created_by',
        'modified_date', 
        'modified_by'
    ];
    
}
