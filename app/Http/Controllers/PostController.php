<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Show a list of all posts.
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::all();

        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @return RedirectResponse
     */
    public function store(): RedirectResponse
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => '',
        ]);
        $tags = $data['tags'];
        unset($data['tags']);

        // create Post
        $post = Post::create($data);
        $post->tags()->attach($tags);

        return redirect()->route('post.index');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Post $post)
    {
        $data = request()->validate([
            'title' => 'required|string',
            'content' => 'string',
            'image' => 'string',
            'category_id' => '',
            'tags' => ''
        ]);

        $tags = $data['tags'];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
        return redirect()->route('post.show', $post->id);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('post.index');

    }

    // firstOrCreate
    // updateOrCreate

    public function firstOrCreate(): void
    {
        $anotherPost = [
            'title' => 'title 343',
            'content' => 'content 3',
            'image' => 'image4.jpg',
            'likes' => 43,
            'is_published' => 1,
        ];

        $post = Post::firstOrCreate(
            [
                'title' => 'title 34'
            ],
            [
                'title' => 'title4',
                'content' => 'content 34',
                'image' => 'image4.jpg',
                'likes' => 43,
                'is_published' => 1,
            ]
        );

        dump($post->content);
    }

    public function updateOrCreate(): void
    {
        $anotherPost = [
            'title' => 'update_or_create 343',
            'content' => 'content 3',
            'image' => 'image4.jpg',
            'likes' => 43,
            'is_published' => 1,
        ];

        $post = Post::updateOrCreate(
            [
                'title' => 'update_or_create'
            ],
            [
                'title' => 'update_or_creatdfde 343',
                'content' => 'content 3sdf',
                'image' => 'image4.jpg',
                'likes' => 43,
                'is_published' => 1,
            ]);

        dd($post->title);
    }
}
