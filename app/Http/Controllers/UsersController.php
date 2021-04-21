<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //

    public function getUsers()
    {
    	return response()->json(User::get());
    }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'surname' => 'required',
            'login' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        User::create($req->all());
        return response()->json('Регистрация прошла успешно');
    }

    public function login(Request $req) 
    {
        $validator = Validator::make($req->all(), [
            'login' => 'required|exists:users,login',
            'password' => 'required|exists:users,password',
        ]);

        $user = User::where("login",$req->login)->first();

        if ($validator->fails()) {
            if(!$user || $req->password!=$user->password)
                return response()->json('Логин или пароль введены неверно');
            return response()->json($validator->errors());
        }

        return response()->json('Авторизация прошла успешно, api_token юзера: '.$user->generateToken());
    }

    public function updateUser(Request $req)
    {
        $user = User::where("id",$req->id)->first();

        if(!$user || $user->api_token == null)
            return response()->json("Запись не найдена");
        
        $user->update($req->all());
        return response()->json("Запись изменена");
    }

    public function deleteUser(Request $req)
    {
        $user = User::where("name", $req->name)->first();

        if(!$user || $user->api_token == null)
            return response()->json("Запись не найдена");
        
        $user->delete();
        return response()->json("Аккаунт удален");
    }

}
