<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;


    protected  $fillable = [
      'first_name',
      'last_name',
      'email',
      'position',
      'department',
      'work_start_date'
    ];


    public function giftcard() {
        return $this->hasOne(Giftcard::class);
    }

    public function  user() {
        return $this->belongsTo(User::class);
    }
}
