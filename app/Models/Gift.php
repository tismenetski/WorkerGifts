<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'value',
        'image',
        'gift_category_id'
    ];


    public function gift_category() {
        return $this->belongsTo(GiftCategory::class);
    }
}
