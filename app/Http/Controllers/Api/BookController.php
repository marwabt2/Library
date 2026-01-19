<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\ResponseHelper;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::with(['category', 'authors'])->get();
        return ResponseHelper::success('جميع الكتب', $books);
    }

    
    public function store(StoreBookRequest $request)
    {
        $book = Book::create(
            $request->except(['authors', 'cover'])
        );

        if ($request->has('authors')) {
            $book->authors()->attach($request->authors);
        }

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = $request->ISBN . '.' . $file->extension();
            Storage::putFileAs('book-images', $file, $filename);

            $book->cover = $filename;
            $book->save();
        }

        return ResponseHelper::success(
            "تمت إضافة الكتاب",
            $book->load(['category', 'authors'])
        );
    }

   
    public function show(Book $book)
    {
        return ResponseHelper::success(
            'تفاصيل الكتاب',
            $book->load(['category', 'authors'])
        );
    }

    /**
     * Update the specified resource in storage.
     * تعديل كتاب + استبدال المؤلفين + تعديل الصورة
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update(
            $request->except(['authors', 'cover'])
        );

        if ($request->has('authors')) {
            $book->authors()->sync($request->authors);
        }

        if ($request->hasFile('cover')) {

            if ($book->cover) {
                Storage::delete('book-images/' . $book->cover);
            }

            $file = $request->file('cover');
            $filename = $request->ISBN . '.' . $file->extension();
            Storage::putFileAs('book-images', $file, $filename);

            $book->cover = $filename;
            $book->save();
        }

        return ResponseHelper::success(
            "تم تعديل الكتاب",
            $book->load(['category', 'authors'])
        );
    }

   
    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::delete('book-images/' . $book->cover);
        }

        $book->authors()->detach();

        $book->delete();

        return ResponseHelper::success(
            "تم حذف الكتاب",
            $book
        );
    }
}
