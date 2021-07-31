<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Comment $comment)
    {
        $comment->favorite();

        return back();
    }
}
