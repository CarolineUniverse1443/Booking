<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
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
        $validator = Validator::make($req->all(), [
            'user_id' => 'required|integer',
            'single_flight' => 'required|integer',
            'single_data' => 'required|date',
            'return_flight' => 'nullable|integer',
            'return_data' => 'nullable|date',
            'book_id' => 'nullable',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        Book::create($req->all());
        $book = Book::where("user_id",$req->user_id)->first();
        $book->book_id = Str::random(5);
        return response()->json('Бронь добавлена');
    }

    public function updateBook(Request $req)
    {
        $book = Book::where("id",$req->id)->first();

        if(!$book)
            return response()->json("Запись не найдена");
        
        $book->update($req->all());
        return response()->json("Запись изменена");
    }

    public function deleteBook(Request $req)
    {
        $book = Book::where("id", $req->id)->first();

        if(!$book)
            return response()->json("Бронь не найдена");
        
        $book->delete();
        return response()->json("Бронь удалена");
    }

}
