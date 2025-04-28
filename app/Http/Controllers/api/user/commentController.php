<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\commentRequest;
use App\Interface\commentInterface;
use Illuminate\Http\Request;

class commentController extends Controller
{
    use apiResponse;
    private $commentRepository;
    public function __construct(commentInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function index()
    {
        $data=$this->commentRepository->index();
        return $this->apiResponse($data,'Comments fetched successfully');
    }

    public function show()
    {
        $data=$this->commentRepository->show(request('id'));
        return $this->apiResponse($data,'Comment fetched successfully');
    }

    public function store(commentRequest $request)
    {
        $fields=$request->validated();
        $data=$this->commentRepository->store($fields,request('post_id'));
        return $this->apiResponse($data,'Comment created successfully');
    }

    public function update(commentRequest $request)
    {
        $fields=$request->validated();
        $data=$this->commentRepository->update($fields,request('id'));
        return $this->apiResponse($data,'Comment updated successfully');
    }

    public function destroy()
    {
        $data=$this->commentRepository->destroy(request('id'));
        return $this->apiResponse($data,'Comment deleted successfully');
    }


}
