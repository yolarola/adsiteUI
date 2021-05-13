<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'parent_id',
    ];

    public function parent()
    {
        return $this -> hasOne(Category::class, 'id', 'parent_id');
    }
    
}
