<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

use App\Category;
use App\Note;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('main', compact('categories'));
    }

    public function savenote(Request $request)
    {
        // print_r(json_encode($request->all()));
        // die;
        if(Auth::check()){
            $user_id = Auth::id();
            $request -> validate(['title' => 'required']);
            $note = new Note([
                'user_id' => $user_id,
                'title' => $request -> get('title'),
                'note' => $request -> get('editordata'),
                'category_id' => $request -> get('category')
            ]);

            $note -> save();
            return redirect() -> back() -> with('message', 'Sačuvano!');
        }
    }

    public function update(Request $request)
    {
        // print_r(json_encode($request->all()));
        // die;
        if(Auth::check()){
            $user_id = Auth::id();
            $request -> validate(['title' => 'required']);
            $category_id = $request -> get('category');

            $note = Note::where('id', $request -> get('note_id'))->first();
            $note -> title = $request -> get('title');
            $note -> note = $request -> get('editordata');
            $note -> category_id = $category_id;

            $note -> save();

            return redirect() -> back() -> with('message', 'Sačuvano!');
        }
    }

    public function show($id){
        $note=Note::where('id', $id)->with('category')->first();
        // print_r(json_encode($note));
        // die;
        return view('show', compact('note'));
    }

    public function edit($id){
        $categories = Category::all();
        $note=Note::where('id', $id)->first();
        return view('edit', compact('note', 'categories'));
    }
}
