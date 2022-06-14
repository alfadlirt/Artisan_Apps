<?php

namespace APP\Models;

use CodeIgniter\Model;

class ExpeditionModel extends Model
{
    protected $table = 'expedition';
    protected $primaryKey = 'exp_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'exp_name',
        'status', 
        'created_date', 
        'created_by',
        'modified_date', 
        'modified_by'
    ];
    
}
