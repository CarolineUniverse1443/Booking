<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BooksController extends Controller
{
	//

	public function getBooks()
	{
		return response()->json(Book::get());
	}

	public function addBook(Request $req)
	{
		$user  = User::where("api_token",  $req->header("api_token"))->first();

		if(!$user)
			return  resрonse()->json("Пользователь  не  авторизован");

		$validator = Validator::make($req->all(), [
			'single_flight' => 'required|integer',
			'single_data' => 'required|date',
			'return_flight' => 'nullable|integer',
			'return_data' => 'nullable|date',
		]);

		if ($validator->fails())
			return response()->json($validator->errors());
		
		$book_id  =  Str::random(5);

		$booking  =
		[
		"user_id"  =>  $user->id,
		"book_id"  =>  $book_id,
		'single_flight'  =>  $req->single_flight,
		'single_data'  =>  $req->single_data,
		'return_flight'  =>  $req->return_flight,
		'return_data'  =>  $req->return_data,
		];

		Book::create($booking);
		return response()->json(
		[
			"code" => $book_id
		]);
	}

	public function updateBook(Request $req)
	{
		$user  = User::where("api_token",  $req->header("api_token"))->first();

		if(!$user)
			return  resрonse()->json("Пользователь  не  авторизован");

		$book = Book::where("id",$req->id)->first();

		if(!$book)
			return response()->json("Запись не найдена");

		if($user->id  !=  $book->user_id)
 			return response()->json("He трожь, paз нe твоё");
		
		$book->update($req->all());
		return response()->json("Запись изменена");
	}

	public function deleteBook(Request $req)
	{
		$user  = User::where("api_token",  $req->header("api_token"))->first();

		if(!$user)
			return  resрonse()->json("Пользователь  не  авторизован");

		$book = Book::where("id", $req->id)->first();

		if(!$book)
			return response()->json("Бронь не найдена");

		if($user->id  !=  $book->user_id)
			return response()->json("Шалость не удалась");
		
		$book->delete();
		return response()->json("Бронь удалена");
	}

}
