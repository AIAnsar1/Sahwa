<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Authors, User};



class AuthorsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_authors_index_request(): void
    {
        Authors::factory()->count(3)->create();
        $response = $this->get("/api/application/authors");
        $response->assertStatus(200);
        $response->assertJsonCount(3, "data");
    }

    public function test_post_authors_store_request(): void
    {
        $user = User::factory()->create();
        $data = [
            "bio" => "Backend developer",
            "position" => "Senior PHP Dev",
            "users_id" => $user->id,
        ];
        $response = $this->post("/api/application/authors", $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas("authors", $data);
    }

    public function test_get_authors_show_request(): void
    {
        $author = Authors::factory()->create();
        $find = Authors::find($author->id);
        $response = $this->get("/api/application/authors/{$author->id}");
        $response->assertStatus(200);
        $response->assertJsonPath("data.id", $find->id);
        $response->assertJsonPath("data.position", $find->position);
    }

    public function test_put_authors_update_request(): void
    {
        $user = User::factory()->create();
        $author = Authors::factory()->create(['users_id' => $user->id]);
        $update = [
            "bio" => "Updated bio",
            "position" => "Updated position",
            "users_id" => $user->id,
        ];
        $response = $this->put("/api/application/authors/{$author->id}", $update);
        $response->assertStatus(200);
        $this->assertDatabaseHas("authors", $update);
    }

    public function test_delete_authors_delete_request(): void
    {
        $author = Authors::factory()->create();
        $response = $this->delete("/api/application/authors/{$author->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing("authors", ["id" => $author->id]);
    }
}
