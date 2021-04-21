<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //use HasFactory;
    public $timestamps = false;

    public $fillable = ['user_id','single_flight', 'single_data', 'return_flight', 'return_data', 'book_id'];
}
