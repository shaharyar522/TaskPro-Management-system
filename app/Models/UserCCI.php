<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCCI extends Model
{
    protected $table = 'userdata_cci';

      protected $fillable = [
        'phone',
        'address',
        'master_order',
        'job_notes',
        'work_type',
        'unit',
        'qty',
        'w2',
        'in',
        'out',
        'hours',
        'user_id',
    ];


    function  user()
    {
        return $this->belongsTo(user::class);
    }

}
