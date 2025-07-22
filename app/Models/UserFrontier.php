<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFrontier extends Model
{
     protected $table = 'userdata_frontier'; 

protected $fillable = [
    'corp_id', 'address', 'billing_TN', 'order_number',
    'install_T_T_Soc_TTC', 'ont_Ntd', 'comp_or_refer', 'billing_code',
    'qty', 'description', 'rate', 'total_billed',
    'aerial_buried', 'fiber', 'closeout_notes',
    'in', 'out', 'hours', 'user_id'
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
