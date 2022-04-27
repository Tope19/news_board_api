<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function getAll()
    {
        return $this->comment->all();
    }

    public function getById($id)
    {
        return $this->comment->find($id);
    }

    public function create(array $data)
    {
        return $this->comment->create($data);
    }

    public function update($id, array $data)
    {
        $comment = $this->comment->find($id);
        $comment->update($data);

        return $comment;
    }

    public function delete($id)
    {
        $comment = $this->comment->find($id);
        $comment->delete();

        return $comment;
    }

    public function upvote($id)
    {
        $comment = $this->comment->find($id);
        return $comment;
    }
}
