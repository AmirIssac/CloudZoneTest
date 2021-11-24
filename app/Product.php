<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'color_id','description', 'price','is_favorite',
    ];

    public function color(){
        return $this->belongsTo(Color::class);
    }
}
