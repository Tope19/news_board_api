<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateComment()
    {
        $params = [
            'post_id'   => 1,
            'author_name' => 'Tope Olotu',
            'content' => 'This is a comment',
        ];

        $this->json('POST','/api/comments', $params, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);

    }

    public function testGetAllComments(){
        $this->json('GET','/api/comments', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testSingleComment(){
        $this->json('GET','/api/comments/1', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testUpdateComment(){
        $params = [
            'post_id'   => 1,
            'author_name' => 'Tope Olotu',
            'content' => 'This is a comment',
        ];

        $this->json('PUT','/api/comments/1', $params, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'updated' => true,
            ]);
    }

    public function testDeleteComment(){
        $this->json('DELETE','/api/comments/1', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'deleted' => true,
            ]);
    }
}
