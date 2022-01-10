<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostCommentsController extends Controller
{
	public function store(Post $post, CommentRequest $request)
	{
		$request->validated();

		$post->comments()->create([
			'user_id' => request()->user()->id,
			'body'    => request('body'),
		]);

		return back();
	}
}
