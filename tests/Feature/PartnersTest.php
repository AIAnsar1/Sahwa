<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Partners;



class PartnersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_partners_inext_request(): void
    {
        $response = $this->get("/api/application/partners");
        $response->assertStatus(200);
    }

    public function test_post_partners_store_request(): void
    {
        $response = $this->post("/api/application/partners", [
            "title" => "Example Partner",
            "logo" => "This is an example partner.",
            "link" => "https://example.com",
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('partners', ["title" => "Example Partner", "logo" => "This is an example partner.", "link" => "https://example.com"]);
    }

    public function test_get_partners_show_request(): void
    {
        $partners = Partners::factory()->create();
        $find = Partners::find($partners->id);
        $response = $this->get("/api/application/partners/{$partners->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
        $response->assertJsonPath('data.title', $find->title);
        $response->assertJsonPath('data.logo', $find->logo);
        $response->assertJsonPath('data.link', $find->link);
    }

    public function test_put_partners_update_request(): void
    {
        $partners = Partners::factory()->create();
        $response = $this->put("/api/application/partners/{$partners->id}", [
            "title" => "Example Partner",
            "logo" => "This is an example partner.",
            "link" => "https://example.com",
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('partners', ["title" => "Example Partner", "logo" => "This is an example partner.", "link" => "https://example.com"]);
    }

    public function test_delete_partners_delete_request(): void
    {
        $partners = Partners::factory()->create();
        $response = $this->delete("/api/application/partners/{$partners->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('partners', ['id' => $partners->id]);
    }
}
