<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            (object)['title' => 'Della belajar MVC', 'content' => 'Della belajar MVC di Laravel'],
            (object)['title' => 'Della Implementasi Controller dan View', 'content' => 'Della belajar Laravel di framework PHP'],
        ];

        return view('posts.index', compact('posts'));
    }
}
