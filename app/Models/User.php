<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
    //use HasFactory;
    public $timestamps = false;

    public $fillable = ['name', 'surname', 'login','password', 'api_token'];

    public function generateToken()
	{
		$token = Str::random(50);
		$this->api_token = $token;
		$this->save();
		return $token;
	}
}
