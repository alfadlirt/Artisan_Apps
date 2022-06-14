<?php

namespace APP\Models;

use CodeIgniter\Model;

class FeatureModel extends Model
{
    protected $table = 'lst_feature';
    protected $primaryKey = 'ftr_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'ftr_id',
        'ftr_name', 
        'ftr_desc', 
        'status',
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
