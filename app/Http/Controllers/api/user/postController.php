<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\postRequest;
use App\interface\postInterface;
use App\Models\post;
use Illuminate\Http\Request;

class postController extends Controller
{
    use apiResponse;
    private $postRepository;

    public function __construct(postInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->index();
        if (count($posts) == 0) {
            return $this->sendError('No Posts Available');
        }
        return $this->apiResponse($posts, 'Posts fetched successfully');
    }

    public function show()
    {
        $post = $this->postRepository->show(request('id'));
        if (!$post) {
            return $this->sendError('Post not found');
        }
        return $this->apiResponse($post, 'Post fetched successfully');
    }

    public function store(postRequest $request)
    {
        $fields = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->storeAs('public/posts', $filename);
            $fields['image'] = $filename;
        }
        $post = $this->postRepository->store($fields);
        return $this->apiResponse($post, 'Post created successfully');
    }

    public function update(Request $request, $id)
    {
        $fields = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->storeAs('public/posts', $filename);
            $fields['image'] = $filename;
        }
        $post = $this->postRepository->update($fields, $id);
        return $this->apiResponse($post, 'Post updated successfully');
    }

    public function destroy()
    {
        $post = $this->postRepository->destroy(request('id'));
        return $this->apiResponse($post, 'Post deleted successfully');
    }

}
