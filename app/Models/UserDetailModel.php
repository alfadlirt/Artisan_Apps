<?php

namespace APP\Models;

use CodeIgniter\Model;

class UserDetailModel extends Model
{
    protected $table = 'lst_user_rbt_dtl';
    protected $primaryKey = 'usr_dtl_id';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'usr_id',
        'nft_token', 
        'rbt_id', 
        'power_pts', 
        'intelligence_pts', 
        'agility_pts',
        'created_date', 
        'created_by', 
        'modified_date', 
        'modified_by'
    ];
    
}
