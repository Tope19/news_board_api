<?php

namespace App\Services;

use Carbon\Carbon;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public  function getAll()
    {
        try {
            $posts = $this->postRepository->getAll();
            return response()->json([
                'data' => PostResource::collection($posts),
                'message' => 'Successfully retrieved posts',
                'status' => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function getById($id)
    {
        try {
            $post = $this->postRepository->getById($id);
            return response()->json([
                'data' => new PostResource($post),
                'message' => 'Retrieved Single Post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function create(array $data)
    {
        try {
            $data['creation_date'] = Carbon::now()->format('Y-m-d');
            $post = $this->postRepository->create($data);
            return response()->json([
                'data' => new PostResource($post),
                'message' => 'Successfully Created Post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update($id, array $data)
    {
        try {
            $data['creation_date'] = Carbon::now()->format('d-m-Y');
            $post = $this->postRepository->update($id, $data);
            return response()->json([
                'data' => new PostResource($post),
                'message' => 'Successfully Updated Post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $post = $this->postRepository->delete($id);
            return response()->json([
                'message' => 'Successfully deleted Post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function upvote($id)
    {
        try {
            $post = $this->postRepository->upvote($id);
            $post->increment('upvotes');
            return response()->json([
                'message' => 'Successfully Upvoted a post',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function resetUpvotes()
    {

        $post = $this->postRepository->getAll();
        $post->upvotes = 0;
        $post->save();
        return $post;
    }
}
