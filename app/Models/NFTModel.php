<?php

namespace APP\Models;

use CodeIgniter\Model;

class NFTModel extends Model
{
    protected $table = 'lst_nft';
    protected $primaryKey = 'nft_token';
    protected $useTimestamps = false;
    protected $useAutoIncrement = false;
    protected $allowedFields = [
        'nft_token',
        'rbt_id',
        'link',
        'is_registered',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by'
    ];
    
}
