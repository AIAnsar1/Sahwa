<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Comments, User, Articles};



class CommentsTest extends TestCase
{
    use RefreshDatabase;


    public function test_get_comments_index_request(): void
    {
        $response = $this->get("/api/application/comments");
        $response->assertStatus(200);
    }

    public function test_post_comments_store_request(): void
    {
        $user = User::factory()->create();
        $article = Articles::factory()->create();
        $response = $this->post("/api/application/comments", [
            'content' => 'Test comment content',
            'users_id' => $user->id,
            'articles_id' => $article->id,
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', [
            'content' => 'Test comment content',
            'users_id' => $user->id,
            'articles_id' => $article->id,
        ]);
    }

    public function test_get_comments_show_request(): void
    {
        $comment = Comments::factory()->create();
        $freshComment = Comments::with(['user', 'articles'])->find($comment->id);
        $response = $this->get("/api/application/comments/{$comment->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $freshComment->id);
        $response->assertJsonPath('data.content', $freshComment->content);
    }

    public function test_put_comments_update_request(): void
    {
        $user = User::factory()->create();
        $article = Articles::factory()->create();
        $comment = Comments::factory()->create([
            'users_id' => $user->id,
            'articles_id' => $article->id,
        ]);
        $response = $this->put("/api/application/comments/{$comment->id}", [
            'content' => 'Updated comment content',
            'users_id' => $user->id,
            'articles_id' => $article->id,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'content' => 'Updated comment content',
        ]);
    }

    public function test_delete_comments_delete_request(): void
    {
        $comment = Comments::factory()->create();
        $response = $this->delete("/api/application/comments/{$comment->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }
}
