<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'description',
        'price',
        'quantity',
        'category',
        'acquired_on'
    ];

    public function container() {
        return $this->belongsTo('App\Models\Stock', 'item_name', 'id');
    }
}
