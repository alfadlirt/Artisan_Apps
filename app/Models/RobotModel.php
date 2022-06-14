<?php

namespace APP\Models;

use CodeIgniter\Model;

class RobotModel extends Model
{
    protected $table = 'lst_robot';
    protected $primaryKey = 'identifier';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'rbt_id',
        'rbt_code', 
        'rbt_name',
        'rbt_desc', 
        'status', 
        'nft_generated',
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
