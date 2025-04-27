<?php


namespace App\Repository;

use App\Models\Post;
use App\interface\postInterface;
use Illuminate\Support\Str;

class postRepository implements postInterface
{
    public function index()
    {
        return Post::all();
    }

    public function show($id)
    {
        return Post::findOrFail($id);
    }

    public function store($request)
    {
        $slug=$this->generateUniqueSlug($request->title, Post::class);
        dd($slug);
        return Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'image'=>$request->image,
            'slug'=>$slug
        ]);
    }

    public function update($request, $id)
    {
        $post=Post::findOrFail($id);
        $post->update($request->all());
        return $post;
    }

    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return $post;
    }

    function generateUniqueSlug($title, $model)
{
    $slug = Str::slug($title);
    $original = $slug;
    $count = 1;

    while ($model::where('slug', $slug)->exists()) {
        $slug = $original . '-' . $count++;
    }

    return $slug;
}
}
