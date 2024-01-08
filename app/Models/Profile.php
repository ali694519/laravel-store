<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','first_name','last_name','birthday',
    'gender','street_address','city','state','postal_code','country','local'];

    protected $primaryKey = 'admin_id';

     public function user() {
        return $this->belongsTo(Admin::class,'admin_id','id');
    }
}
