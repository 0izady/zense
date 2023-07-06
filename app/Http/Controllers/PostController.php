<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Orhanerday\OpenAi\OpenAi;
use Response;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PopularPosts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Providers\RouteServiceProvider;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Post/Create');
    }


    public function top()
    {

        // we can do that too
        $date = Carbon::today()->subDays(7);
        $posts = PopularPosts::where('created_at', '>=',$date)->orderBy('views', 'desc')->take(10)->get();

        return Inertia::render('Post/Top', [
            "tops" => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('img');
        $user_id = Auth::id();

        if ($image) {
            $validated = $request->validate([
                'title' => 'required|unique:posts|max:255',
                'summarize' => 'required',
                'article' => 'required',
                'img' => 'image',
            ]);

            $path = Storage::putFile('upload_img', $image, 'public');
            $path_to_array = explode('/', $path);
            $image->move($path_to_array[0],$path_to_array[1]);

            $user = User::find($user_id); // get the user by id
            $post = $user->posts()->create([ // use the relationship to create a post
                "title" => $request->title,
                "summarize" => $request->summarize,
                "article" => $request->article,
                "img" => $path,
            ]);

        }else {
            $validated = $request->validate([
                'title' => 'required|unique:posts|max:255',
                'summarize' => 'required',
                'article' => 'required',
            ]);

            $user = User::find($user_id); // get the user by id
            $post = $user->posts()->create([ // use the relationship to create a post
                "title" => $request->title,
                "summarize" => $request->summarize,
                "article" => $request->article,
                "img" => "",
            ]);

        }
        return redirect()->route('post.show', ['title' => $request->title])
                         ->with('message', 'پست شما با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     */
    public function show($title)
    {
        $post = Post::where('title', $title)->first();
        if (!$post) {
            abort(404);
        }
        $loginUser = Auth::user();
        if (!$loginUser) {
            $status = false;
        }else {
            $status = $loginUser->can('update', $post);
        }
        $created = $post->created_at->diffForHumans();

        // get popular searches if this key word is in databse,
        // plus one to views and if not make it and set views to one
        $popularPost = PopularPosts::where('key_word', $title)->first();
        if ($popularPost) {
            $views = $popularPost->views;
            $popularPost->update([
                "views" => $views + 1
            ]);
        }else {
            PopularPosts::create([
                "key_word" => $title,
                "views" => 1
            ]);
        }

        return Inertia::render('Post/Show', [
            'post' => $post,
            'user' => $post->user()->first(),
            'created' => $created,
            'status' => $status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($title)
    {
        $post = Post::where('title', $title)->first();
        if (!$post) {
            abort(404);
        }
        $this->authorize('update', $post);

        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('update', $post);
        $popularPost = PopularPosts::where('key_word', $post->title)->first();
        $title = $post->title;

        if ($request->title == $post->title) {
            $validation = 'required|max:255';
        }else {
            $validation = 'required|unique:posts|max:255';
        }

        $image = $request->file('img');
        if ($image) {
            $validated = $request->validate([
                'title' => $validation,
                'summarize' => 'required',
                'article' => 'required',
                'img' => 'image',
            ]);

            $path = Storage::putFile('upload_img', $image, 'public');
            $path_to_array = explode('/', $post->path);
            $image->move($path_to_array[0],$path_to_array[1]);

            $post = $post->update([
                "title" => $request->title,
                "summarize" => $request->summarize,
                "article" => $request->article,
                "img" => $path,
            ]);
        }else {
            $validated = $request->validate([
                'title' => $validation,
                'summarize' => 'required',
                'article' => 'required',
            ]);

            $post = $post->update([
                "title" => $request->title,
                "summarize" => $request->summarize,
                "article" => $request->article,
                "img" => "",
            ]);

        }

        // dd([$request->title, $post->tit]);
        if ($request->title != $title) {
            if ($popularPost) {
                $popularPost->update([
                    'key_word' => $request->title
                ]);
            }
        }

        return redirect()->route('post.show', ['title' => $request->title])
                ->with('message', 'پست شما با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post ,$id)
    {
        $post = $post->where('id', $id)->first();
        $post_history = PopularPosts::where('key_word', $post->title)->first();
        $post->delete();
        $post_history->delete();

        return redirect(RouteServiceProvider::HOME)
                ->with('message', 'پست شما با موفقیت حذف شد');
    }
}
