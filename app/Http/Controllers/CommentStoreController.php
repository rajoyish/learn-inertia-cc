<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // sleep(2);

        $this->authorize('create', Post::class);

        $this->validate($request, [
            'body' => ['required'],
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back()->with('message', [
            'body' => 'Comment posted!',
            'type' => 'success',
        ]);
    }
}
