<?php

namespace App\Services;

use Carbon\Carbon;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;

class CommentService{

    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function getAll()
    {
        try {
            $comments = $this->commentRepository->getAll();
            return response()->json([
                'data' => CommentResource::collection($comments),
                'message' => 'Successfully retrieved comments',
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
            $comment = $this->commentRepository->getById($id);
            return response()->json([
                'data' => new CommentResource($comment),
                'message' => 'Retrieved Single Comment',
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
            $comment = $this->commentRepository->create($data);
            return response()->json([
                'data' =>  new CommentResource($comment),
                'message' => 'Successfully Created Comment',
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
            $data['creation_date'] = Carbon::now()->format('Y-m-d');
            $comment = $this->commentRepository->update($id, $data);
            return response()->json([
                'data' => new CommentResource($comment),
                'message' => 'Successfully Updated Comment',
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
            $comment = $this->commentRepository->delete($id);
            return response()->json([
                'message' => 'Successfully Deleted Comment',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
