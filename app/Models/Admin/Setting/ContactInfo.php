<?php

namespace App\Models\Admin\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    //For Dynamic Search 
    public function scopeSearch($query, $val='')
    {
        return $query
        ->where('phone', 'LIKE', '%'.$val.'%')
        ->Orwhere('email', 'LIKE', '%'.$val.'%')
        ->Orwhere('address', 'LIKE', '%'.$val.'%');
    }
}
