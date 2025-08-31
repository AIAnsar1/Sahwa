<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SocialMedia;



class SocialMediaTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_socialmedia_inext_request(): void
    {
        $response = $this->get("/api/application/social-media");
        $response->assertStatus(200);
    }

    public function test_post_socialmedia_store_request(): void
    {
        $response = $this->post("/api/application/social-media", [
            "platform" => "Facebook",
            "url" => "https://youtu.be",
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('social_medias', ["platform" => "Facebook", "url" => "https://youtu.be"]);
    }

    public function test_get_socialmedia_show_request(): void
    {
        $socialmedia = SocialMedia::factory()->create();
        $find = SocialMedia::find($socialmedia->id);
        $response = $this->get("/api/application/social-media/{$socialmedia->id}");
        $response->assertStatus(200);
        $response->assertJsonPath("data.id", $find->id);
        $response->assertJsonPath("data.platform", $find->platform);
        $response->assertJsonPath("data.url", $find->url);
    }

    public function test_put_socialmedia_update_request(): void
    {
        $socialmedia = SocialMedia::factory()->create();
        $response = $this->put("/api/application/social-media/{$socialmedia->id}", [
            "platform" => "Facebook",
            "url" => "https://youtu.be",
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('social_medias', ['platform' => 'Facebook', 'url' => 'https://youtu.be']);
    }

    public function test_delete_socialmedia_delete_request(): void
    {
        $socialmedia = SocialMedia::factory()->create();
        $response = $this->delete("/api/application/social-media/{$socialmedia->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('social_medias', ['id' => $socialmedia->id]);
    }
}
