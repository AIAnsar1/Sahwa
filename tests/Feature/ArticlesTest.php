<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{Articles, Category, Authors};


class ArticlesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_articles_inext_request(): void
    {
        $response = $this->get("/api/application/articles");
        $response->assertStatus(200);
    }

    public function test_post_articles_store_request(): void
    {
        $category = Category::factory()->create();
        $author = Authors::factory()->create();
        $data = [
            "title" => "Example Title",
            "slug" => "example-title",
            "description" => "Example description",
            "content" => "Example content",
            "views" => 10,
            "thumbnail" => "example.jpg",
            "like" => 5,
            "categories_id" => $category->id,
            "authors_id" => $author->id,
        ];
        $response = $this->post("/api/application/articles", $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('articles', $data);
    }

    public function test_get_articles_show_request(): void
    {
        $article = Articles::factory()->create();
        $category = Category::factory()->create();
        $author = Authors::factory()->create();
        $find = Articles::find($article->id);
        $response = $this->get("/api/application/articles/{$article->id}");
        $response->assertStatus(200);
        $response->assertJsonPath('data.id', $find->id);
        $response->assertJsonPath('data.title', $find->title);
        $response->assertJsonPath('data.slug', $find->slug);
        $response->assertJsonPath('data.description', $find->description);
        $response->assertJsonPath('data.content', $find->content);
        $response->assertJsonPath('data.views', $find->views);
        $response->assertJsonPath('data.thumbnail', $find->thumbnail);
        $response->assertJsonPath('data.like', $find->like);
        $response->assertJsonPath('data.categories_id.id', $category->categories_id);
        $response->assertJsonPath('data.authors_id.id', $author->authors_id);
    }

    public function test_put_articles_update_request(): void
    {
        $article = Articles::factory()->create();
        $newCategory = Category::factory()->create();
        $newAuthor = Authors::factory()->create();
        $data = [
            "title" => "Updated Title",
            "slug" => "updated-title",
            "description" => "Updated description",
            "content" => "Updated content",
            "views" => 20,
            "thumbnail" => "updated.jpg",
            "like" => 15,
            "categories_id" => $newCategory->id,
            "authors_id" => $newAuthor->id,
        ];
        $response = $this->put("/api/application/articles/{$article->id}", $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('articles', $data);
    }

    public function test_delete_articles_delete_request(): void
    {
        $article = Articles::factory()->create();
        $response = $this->delete("/api/application/articles/{$article->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }
}
