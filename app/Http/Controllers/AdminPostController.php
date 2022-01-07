<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{	
	public function index()
	{
		return view('admin.posts.index', [
			'posts' => Post::paginate(50),
		]);
	}

	public function create()
	{
		$categories = Category::all();
		return view('admin.posts.create', ['categories' => $categories]);
		
	}

	public function store()
	{
		$post = new Post();

		$attributes = $this->validatePost();

		$attributes['user_id'] = auth()->id();
		$attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

		Post::create($attributes);

		return redirect('/');
	}

	public function edit(Post $post)
	{
		$categories = Category::all();

		return view('admin.posts.edit', ['post' => $post, 'categories' => $categories]);
	}

	public function update(Post $post)
	{
		$attributes = $this->validatePost($post);

		if (isset($attributes['thumbnail']))
		{
			$attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
		}

		$post->update($attributes);

		return back()->with('success', 'Post Updated!');
	}

	public function destroy(Post $post)
	{

		$post->delete();
		return back()->with('success', 'Post Deleted!');
	}

	protected function validatePost(?Post $post = null): array
	{
		$post ??= new Post();

		$attributes = request()->validate([
			'title'      => 'required',
			'slug'       => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
			'thumbnail'  => $post->exists ? ['image'] : ['required|image'],
			'excerpt'    => 'required',
			'body'       => 'required',
			'category_id'=> ['required', Rule::exists('categories', 'id')],
		]);

		return $attributes;
	}
}
