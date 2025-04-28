<?php

namespace App\Repository;

use App\Interface\commentInterface;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class commentRepository implements commentInterface
{
    public function index()
    {
        return Comments::all();
    }
    public function show($id)
    {
        return Comments::findOrFail($id);
    }
    public function store($request,$id)
    {
        return Comments::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id'=>$id
        ]);
    }
    public function update($request, $id)
    {

    }

    public function destroy($id)
    {
        $comment=Comments::find($id);
        $comment->delete();
        return $comment;
    }
}
