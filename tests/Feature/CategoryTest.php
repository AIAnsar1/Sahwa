<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;


class CategoryTest extends TestCase
{
    public function test_get_categories_index_request(): void
    {
        $response = $this->get("/api/application/categories");
        $response->assertStatus(200);
    }

    public function test_post_category_store_request(): void
    {
        $response = $this->post("/api/application/categories", [
            "title" => "gogo",
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ["title" => "gogo"]);
    }

    public function test_get_category_show_request(): void
    {
        $category = Category::factory()->create();
        $find = Category::find($category->id);
        $response = $this->get("/api/application/categories/{$category->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
        $response->assertJsonPath('data.title', $find->title);
        $response->assertJsonPath('data.slug', $find->slug);
    }

    public function test_put_category_update_request(): void
    {
        $category = Category::factory()->create();
        $find = Category::find($category->id);
        $data = [
            "title" => "undying",
        ];
        $response = $this->put("/api/application/categories/{$category->id}", $data);
        $this->assertDatabaseHas('categories', $data);
    }

    public function test_delete_category_request(): void
    {
        $category = Category::factory()->create();
        $response = $this->delete("/api/application/categories/{$category->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
