<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(){

        $comments = Comment::latest()->get();

        return view('admin.comments', compact('comments'));
    }
}
