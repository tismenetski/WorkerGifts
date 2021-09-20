<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giftcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'valid_until',
        'issued_at',
        'amount'
    ];



    public function worker() {
        return $this->belongsTo(Worker::class);
    }


}
