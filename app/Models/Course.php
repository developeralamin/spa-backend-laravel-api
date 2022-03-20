<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

      public $timestamps = false;

    protected $fillable = ['title','photo','description','category_id'];

     public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

}
