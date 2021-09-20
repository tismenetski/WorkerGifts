<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;


    public function gift_category() {
        return $this->belongsTo(GiftCategory::class);
    }
}
