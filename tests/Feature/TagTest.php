<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;

class TagTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_tag_inext_request(): void
    {
        $response = $this->get("/api/application/tags");
        $response->assertStatus(200);
    }

    public function test_post_tag_store_request(): void
    {
        $response = $this->post("/api/application/tags", [
            'title' => 'Example Tag',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tags', ['title' => 'Example Tag']);
    }

    public function test_get_tag_show_request(): void
    {
        $tag = Tag::factory()->create();
        $freshTag = Tag::find($tag->id);
        $response = $this->get("/api/application/tags/{$tag->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $freshTag->id);
        $response->assertJsonPath('data.title', $freshTag->title);
        $response->assertJsonPath('data.slug', $freshTag->slug);
    }

    public function test_put_tag_update_request(): void
    {
        $tag = Tag::factory()->create();
        $response = $this->put("/api/application/tags/{$tag->id}", [
            'title' => 'Updated Tag',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('tags', ['title' => 'Updated Tag']);
    }

    public function test_delete_tag_delete_request(): void
    {
        $tag = Tag::factory()->create();
        $response = $this->delete("/api/application/tags/{$tag->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
