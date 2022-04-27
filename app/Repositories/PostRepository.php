<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function getAll()
    {
        return $this->post->all();
    }

    public function getById($id)
    {
        return $this->post->find($id);
    }

    public function create(array $data)
    {
        return $this->post->create($data);
    }

    public function update($id, array $data)
    {
        $post = $this->post->find($id);
        $post->update($data);

        return $post;
    }

    public function delete($id)
    {
        $post = $this->post->find($id);
        $post->delete();

        return $post;
    }

    public function upvote($id)
    {
        $post = $this->post->find($id);

        return $post;
    }
}
