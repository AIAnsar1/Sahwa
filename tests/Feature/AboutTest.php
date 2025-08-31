<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\About;


class AboutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_about_index_request(): void
    {
        $response = $this->get("/api/application/abouts");
        $response->assertStatus(200);
    }

    public function test_post_about_store_request(): void
    {
        $data = [
            "title" => "About Title",
            "content" => "Some content",
            "photo" => "photo.jpg",
            "description" => "Some description",
        ];
        $response = $this->post("/api/application/abouts", $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('abouts', $data);
    }

    public function test_get_about_show_request(): void
    {
        $about = About::factory()->create();
        $response = $this->get("/api/application/abouts/{$about->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $about->id);
    }

    public function test_put_about_update_request(): void
    {
        $about = About::factory()->create();
        $data = [
            "title" => "Updated Title",
            "content" => "Updated content",
            "photo" => "updated.jpg",
            "description" => "Updated description",
        ];
        $response = $this->put("/api/application/abouts/{$about->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('abouts', $data);
    }

    public function test_delete_about_request(): void
    {
        $about = About::factory()->create();
        $response = $this->delete("/api/application/abouts/{$about->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('abouts', ['id' => $about->id]);
    }
}
