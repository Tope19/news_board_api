<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreatePost()
    {
        $params = [
            'title'   => 'Uefa Champions League',
            'link'    => 'https://topeolotu.xyz',
            'author_name' => 'Tope Olotu',
        ];

        $this->json('POST','/api/posts', $params, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);

    }

    public function testGetAllPosts(){
        $this->json('GET','/api/posts', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testSinglePost(){
        $this->json('GET','/api/posts/1', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testUpdatePost(){
        $params = [
            'title'   => 'Uefa Champions League',
            'link'    => 'https://topeolotu.xyz',
            'author_name' => 'Tope Olotu',
        ];

        $this->json('PUT','/api/posts/1', $params, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'updated' => true,
            ]);
    }
}
