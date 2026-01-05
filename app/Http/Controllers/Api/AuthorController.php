<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use App\ResponseHelper;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors =  Author::all();
       return ResponseHelper::success(' جميع الكتاب',$authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:70'
        ]);
        $author = new Author();
        $author->name = $request->name;
        $author->save();
        return ResponseHelper::success("تمت إضافة الكاتب" , $author);
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:70'
        ]);

        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();
        return ResponseHelper::success("تم تعديل الكاتب" , $author);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $author->delete();
        return ResponseHelper::success("تم حذف الكاتب" , $author);
    }
}
