<?php

namespace App\Models;

use App\Models\Bookborrowing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public function Bookborrowing(){
      return $this->hasMany(Bookborrowing::class, 'book_id');
    }
}

