<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ["name","article","status","data"];


    /**
     * @param $query
     * @return mixed
     */
    public function scopeAvailable($query): mixed
    {
        return $query->where('status','available');
    }

}
