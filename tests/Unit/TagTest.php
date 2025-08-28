<?php

namespace Tests\Unit;

use Tests\TestCase; // <- Laravel TestCase
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use App\Models\Tag;

class TagTest extends TestCase
{
    use RefreshDatabase;

    private function makeModel(array $overrides = []): Tag
    {
        return Tag::factory()->make($overrides);
    }

    private function createModel(array $overrides = []): Tag
    {
        return Tag::factory()->create($overrides);
    }

    public function test_can_create_model(): void
    {
        $model = $this->makeModel();
        $this->assertInstanceOf(Tag::class, $model);
    }

    public function test_can_store_model(): void
    {
        $model = $this->createModel();
        $this->assertDatabaseHas('tags', ['id' => $model->id]);
    }

    public function test_can_update_model(): void
    {
        $model = $this->createModel();
        $model->update(['title' => 'Updated Title']);
        $this->assertEquals('Updated Title', $model->fresh()->title);
    }

    public function test_can_delete_model(): void
    {
        $model = $this->createModel();
        $model->delete();
        // change crud_generators to your migration name
        $this->assertDatabaseMissing('tags', [
            'id' => $model->id,
        ]);
    }

    public function test_can_find_model(): void
    {
        $model = $this->createModel();
        $found = Tag::find($model->id);
        $this->assertNotNull($found);
        $this->assertEquals($model->id, $found->id);
    }
}
