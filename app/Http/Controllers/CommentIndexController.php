<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return inertia()->render('Comments/Index');
    }
}
